{{--
    حقول رفع وسائط الحدث (صورة أو فيديو) — مشتركة بين شاشتي الإضافة والتعديل.
    المتغيرات: $currentType، $currentAlt، $required، $eventImage (السجل الحالي في التعديل أو null)
--}}

<div class="ff-card">
    <div class="ff-card__head"><i class="fa fa-photo"></i> نوع الملف</div>
    <div class="ff-grid">
        <div class="ff-field ff-field--full">
            <label>اختر نوع الملف اللي هترفعه <span class="req">*</span></label>
            <div class="ff-typeswitch">
                <label class="ff-type" data-type="image">
                    <input type="radio" name="type" value="image" {{ $currentType === 'image' ? 'checked' : '' }}>
                    <span><i class="fa fa-image"></i> صورة</span>
                </label>
                <label class="ff-type" data-type="video">
                    <input type="radio" name="type" value="video" {{ $currentType === 'video' ? 'checked' : '' }}>
                    <span><i class="fa fa-video-camera"></i> فيديو</span>
                </label>
            </div>
            @if ($errors->has('type'))
                <span class="ff-error">{{ $errors->first('type') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="ff-card">
    <div class="ff-card__head"><i class="fa fa-cloud-upload"></i> <span id="media-card-title">الملف</span></div>
    <div class="ff-grid">
        <div class="ff-field ff-field--full">
            <label>
                <span id="media-label">الملف</span>
                @if ($required)
                    <span class="req">*</span>
                @else
                    <span class="opt">(اختياري — اتركه فارغاً للاحتفاظ بالملف الحالي)</span>
                @endif
            </label>

            <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                data-iconname="fa fa-cloud-upload" name="image" id="media-input"
                {{ $required ? 'required' : '' }}>

            <span class="ff-hint" id="media-hint"></span>

            {{-- معاينة الملف الجديد قبل الحفظ --}}
            <img id="media-preview-img" class="ff-current-img" style="display:none" alt="">
            <video id="media-preview-video" class="ff-video-preview" style="display:none" controls playsinline
                preload="metadata"></video>

            @if ($errors->has('image'))
                <span class="ff-error">{{ $errors->first('image') }}</span>
            @endif

            {{-- الملف الحالي في شاشة التعديل --}}
            @if ($eventImage && $eventImage->image)
                <div class="ff-current-wrap">
                    <span class="ff-hint">الملف الحالي ({{ $eventImage->type === 'video' ? 'فيديو' : 'صورة' }}):</span>
                    @if ($eventImage->type === 'video')
                        <video class="ff-video-preview" controls playsinline preload="metadata"
                            src="{{ $eventImage->url }}"></video>
                    @else
                        <img class="ff-current-img" src="{{ $eventImage->url }}" onerror="this.style.display='none'"
                            alt="">
                    @endif
                </div>
            @endif
        </div>

        <div class="ff-field ff-field--full" id="media-alt-field">
            <label>النص البديل للصورة <span class="opt">(مهم للـ SEO)</span></label>
            <input type="text" class="ff-input" name="alt" value="{{ $currentAlt }}"
                placeholder="وصف قصير للصورة (مهم للـ SEO)">
            @if ($errors->has('alt'))
                <span class="ff-error">{{ $errors->first('alt') }}</span>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        (function() {
            var typeInputs = document.querySelectorAll('input[name="type"]');
            var input = document.getElementById('media-input');
            var hint = document.getElementById('media-hint');
            var label = document.getElementById('media-label');
            var cardTitle = document.getElementById('media-card-title');
            var altField = document.getElementById('media-alt-field');
            var previewImg = document.getElementById('media-preview-img');
            var previewVideo = document.getElementById('media-preview-video');
            var previewUrl = null;

            // أقصى حجم يقدر السيرفر يستقبله فعلياً (upload_max_filesize / post_max_size)
            var SERVER_MAX = {{ maxUploadSizeBytes() }};
            var MB = 1048576;

            // الحد الفعلي = الأصغر بين حد الفاليديشن وحد السيرفر
            var IMAGE_MAX = Math.min(10 * MB, SERVER_MAX);
            var VIDEO_MAX = Math.min(100 * MB, SERVER_MAX);

            function mb(bytes) {
                return Math.round(bytes / MB);
            }

            var CONFIG = {
                image: {
                    accept: 'image/*',
                    label: 'الصورة',
                    max: IMAGE_MAX,
                    hint: 'الصيغ المدعومة: JPG أو PNG أو WebP — الحد الأقصى ' + mb(IMAGE_MAX) + ' ميجابايت.'
                },
                video: {
                    accept: 'video/mp4,video/quicktime,video/webm',
                    label: 'الفيديو',
                    max: VIDEO_MAX,
                    hint: 'الصيغ المدعومة: MP4 أو MOV أو WebM — الحد الأقصى ' + mb(VIDEO_MAX) + ' ميجابايت. ' +
                        'يُفضّل ضغط الفيديو قبل الرفع عشان يفتح بسرعة عند الزوار.'
                }
            };

            function currentType() {
                var checked = document.querySelector('input[name="type"]:checked');
                return checked ? checked.value : 'image';
            }

            function clearPreview() {
                if (previewUrl) {
                    URL.revokeObjectURL(previewUrl);
                    previewUrl = null;
                }
                previewImg.style.display = 'none';
                previewImg.removeAttribute('src');
                previewVideo.style.display = 'none';
                previewVideo.removeAttribute('src');
                previewVideo.load();
            }

            function applyType() {
                var type = currentType();
                var conf = CONFIG[type];

                input.setAttribute('accept', conf.accept);
                label.textContent = conf.label;
                cardTitle.textContent = conf.label;
                hint.textContent = conf.hint;
                hint.classList.remove('ff-error');

                // النص البديل خاص بالصور بس
                altField.style.display = type === 'video' ? 'none' : '';

                // تغيير النوع بيلغي أي ملف متختار عشان ما يتبعتش ملف بنوع غلط
                clearInput();
                clearPreview();

                document.querySelectorAll('.ff-type').forEach(function(el) {
                    el.classList.toggle('is-active', el.getAttribute('data-type') === type);
                });
            }

            function clearInput() {
                input.value = '';
                if (window.jQuery && jQuery(input).data('filestyle')) {
                    jQuery(input).filestyle('clear');
                }
            }

            input.addEventListener('change', function() {
                clearPreview();
                var file = input.files && input.files[0];
                if (!file) return;

                // فحص الحجم قبل الرفع عشان المستخدم ميستناش رفع ملف السيرفر هيرفضه
                var conf = CONFIG[currentType()];
                if (file.size > conf.max) {
                    clearInput();
                    hint.textContent = 'حجم الملف ' + mb(file.size) + ' ميجابايت — أكبر من الحد المسموح (' +
                        mb(conf.max) + ' ميجابايت). اضغط الملف أو اختر ملف أصغر.';
                    hint.classList.add('ff-error');
                    return;
                }

                hint.classList.remove('ff-error');
                hint.textContent = conf.hint;

                previewUrl = URL.createObjectURL(file);
                if (currentType() === 'video') {
                    previewVideo.src = previewUrl;
                    previewVideo.style.display = 'block';
                } else {
                    previewImg.src = previewUrl;
                    previewImg.style.display = 'block';
                }
            });

            typeInputs.forEach(function(el) {
                el.addEventListener('change', applyType);
            });

            applyType();
        })();
    });
</script>
