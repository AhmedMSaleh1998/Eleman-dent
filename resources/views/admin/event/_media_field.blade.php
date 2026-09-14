{{--
    الوسيط الرئيسي للحدث: صورة أو فيديو (واحد بس مش الاتنين) — زي صور الأحداث بالظبط.
    اللي يتحفظ هو اللي بيظهر في كارت الحدث على الموقع، والفيديو بيشتغل تلقائياً عند الوقوف عليه.
    المتغيرات: $event (السجل الحالي في التعديل أو null)، $required (إجباري في الإضافة)
--}}

@php
    $currentMediaType = old('media_type', !empty($event) && $event->video ? 'video' : 'image');
@endphp

<div class="ff-card">
    <div class="ff-card__head"><i class="fa fa-photo"></i> نوع الملف</div>
    <div class="ff-grid">
        <div class="ff-field ff-field--full">
            <label>اختر نوع الملف اللي هيظهر في كارت الحدث <span class="req">*</span></label>
            <div class="ff-typeswitch">
                <label class="ff-type" data-type="image">
                    <input type="radio" name="media_type" value="image"
                        {{ $currentMediaType === 'image' ? 'checked' : '' }}>
                    <span><i class="fa fa-image"></i> صورة</span>
                </label>
                <label class="ff-type" data-type="video">
                    <input type="radio" name="media_type" value="video"
                        {{ $currentMediaType === 'video' ? 'checked' : '' }}>
                    <span><i class="fa fa-video-camera"></i> فيديو</span>
                </label>
            </div>
            @if ($errors->has('media_type'))
                <span class="ff-error">{{ $errors->first('media_type') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="ff-card">
    <div class="ff-card__head"><i class="fa fa-cloud-upload"></i> <span id="event-media-card-title">الملف</span></div>
    <div class="ff-grid">
        <div class="ff-field ff-field--full">
            <label>
                <span id="event-media-label">الملف</span>
                @if (!empty($required) && $required)
                    <span class="req">*</span>
                @else
                    <span class="opt">(اختياري — اتركه فارغاً للاحتفاظ بالملف الحالي)</span>
                @endif
            </label>

            {{-- حقلين منفصلين عشان الباك اند بياخد image و video باسمين مختلفين —
                 الجافاسكريبت بيظهر واحد بس حسب النوع المختار وبيفضّي التاني --}}
            <div id="event-image-wrap">
                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                    data-iconname="fa fa-cloud-upload" name="image" id="event-image-input" accept="image/*">
            </div>
            <div id="event-video-wrap" style="display:none">
                <input type="file" class="filestyle" data-placeholder="لم يتم اختيار ملف"
                    data-iconname="fa fa-cloud-upload" name="video" id="event-video-input"
                    accept="video/mp4,video/quicktime,video/webm">
            </div>

            <span class="ff-hint" id="event-media-hint"></span>

            {{-- معاينة الملف الجديد قبل الحفظ --}}
            <img id="event-media-preview-img" class="ff-current-img" style="display:none" alt="">
            <video id="event-media-preview-video" class="ff-video-preview" style="display:none" controls playsinline
                preload="metadata"></video>

            @if ($errors->has('image'))
                <span class="ff-error">{{ $errors->first('image') }}</span>
            @endif
            @if ($errors->has('video'))
                <span class="ff-error">{{ $errors->first('video') }}</span>
            @endif

            {{-- الملف الحالي في شاشة التعديل --}}
            @if (!empty($event) && ($event->video || $event->image))
                <div class="ff-current-wrap">
                    <span class="ff-hint">الملف الحالي ({{ $event->video ? 'فيديو' : 'صورة' }}) — رفع ملف جديد
                        هيستبدله:</span>
                    @if ($event->video)
                        <video class="ff-video-preview" controls playsinline preload="metadata"
                            src="{{ asset('admin_assets/videos/events/' . $event->video) }}"></video>
                    @else
                        <img class="ff-current-img" src="{{ asset('admin_assets/images/events/' . $event->image) }}"
                            onerror="this.style.display='none'" alt="">
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

{{-- شريط تقدم الرفع — يظهر أثناء رفع الفيديو بالخلفية بدل ما الصفحة تعلّق --}}
<div id="event-upload-progress" style="display:none; margin:14px 0;">
    <div style="background:#eef1f4; border-radius:8px; height:12px; overflow:hidden;">
        <div id="event-upload-progress-bar" style="width:0; height:100%; background:#1abc9c; transition:width .2s;">
        </div>
    </div>
    <p id="event-upload-progress-text" style="margin:6px 0 0; font-size:13px; color:#36404a; text-align:center;">
        جاري الرفع...</p>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        (function() {
            var REQUIRED = @json(!empty($required) && $required);
            var typeInputs = document.querySelectorAll('input[name="media_type"]');
            var imageWrap = document.getElementById('event-image-wrap');
            var videoWrap = document.getElementById('event-video-wrap');
            var imageInput = document.getElementById('event-image-input');
            var videoInput = document.getElementById('event-video-input');
            var hint = document.getElementById('event-media-hint');
            var label = document.getElementById('event-media-label');
            var cardTitle = document.getElementById('event-media-card-title');
            var previewImg = document.getElementById('event-media-preview-img');
            var previewVideo = document.getElementById('event-media-preview-video');
            var previewUrl = null;

            // الحد الفعلي = الأصغر بين حد الفاليديشن وحد السيرفر
            var MB = 1048576;
            var SERVER_MAX = {{ maxUploadSizeBytes() }};
            var IMAGE_MAX = Math.min(10 * MB, SERVER_MAX);
            var VIDEO_MAX = Math.min(100 * MB, SERVER_MAX);

            function mb(bytes) {
                return Math.round(bytes / MB);
            }

            var CONFIG = {
                image: {
                    label: 'الصورة',
                    max: IMAGE_MAX,
                    hint: 'الصيغ المدعومة: JPG أو PNG أو WebP — الحد الأقصى ' + mb(IMAGE_MAX) + ' ميجابايت.'
                },
                video: {
                    label: 'الفيديو',
                    max: VIDEO_MAX,
                    hint: 'الصيغ المدعومة: MP4 أو MOV أو WebM — الحد الأقصى ' + mb(VIDEO_MAX) + ' ميجابايت. ' +
                        'يُفضّل ضغط الفيديو قبل الرفع عشان يشتغل بسرعة عند الزوار.'
                }
            };

            function currentType() {
                var checked = document.querySelector('input[name="media_type"]:checked');
                return checked ? checked.value : 'image';
            }

            function currentInput() {
                return currentType() === 'video' ? videoInput : imageInput;
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

            function clearInput(input) {
                input.value = '';
                if (window.jQuery && jQuery(input).data('filestyle')) {
                    jQuery(input).filestyle('clear');
                }
            }

            function applyType() {
                var type = currentType();
                var conf = CONFIG[type];

                imageWrap.style.display = type === 'image' ? '' : 'none';
                videoWrap.style.display = type === 'video' ? '' : 'none';
                label.textContent = conf.label;
                cardTitle.textContent = conf.label;
                hint.textContent = conf.hint;
                hint.classList.remove('ff-error');

                // في الإضافة الملف المختار إجباري — في التعديل اختياري
                imageInput.required = REQUIRED && type === 'image';
                videoInput.required = REQUIRED && type === 'video';

                // تغيير النوع بيفضّي الحقل التاني عشان ميتبعتش صورة وفيديو مع بعض
                clearInput(type === 'image' ? videoInput : imageInput);
                clearPreview();

                document.querySelectorAll('.ff-type').forEach(function(el) {
                    el.classList.toggle('is-active', el.getAttribute('data-type') === type);
                });
            }

            function onFileChange(input, type) {
                clearPreview();
                var file = input.files && input.files[0];
                if (!file) return;

                // فحص الحجم قبل الرفع عشان المستخدم ميستناش رفع ملف السيرفر هيرفضه
                var conf = CONFIG[type];
                if (file.size > conf.max) {
                    clearInput(input);
                    hint.textContent = 'حجم الملف ' + mb(file.size) + ' ميجابايت — أكبر من الحد المسموح (' +
                        mb(conf.max) + ' ميجابايت). اضغط الملف أو اختر ملف أصغر.';
                    hint.classList.add('ff-error');
                    return;
                }

                hint.classList.remove('ff-error');
                hint.textContent = conf.hint;

                previewUrl = URL.createObjectURL(file);
                if (type === 'video') {
                    previewVideo.src = previewUrl;
                    previewVideo.style.display = 'block';
                } else {
                    previewImg.src = previewUrl;
                    previewImg.style.display = 'block';
                }
            }

            imageInput.addEventListener('change', function() {
                onFileChange(imageInput, 'image');
            });
            videoInput.addEventListener('change', function() {
                onFileChange(videoInput, 'video');
            });
            typeInputs.forEach(function(el) {
                el.addEventListener('change', applyType);
            });

            applyType();

            // ============================================================
            // رفع الفورم بالخلفية (AJAX) مع شريط تقدم لما يكون فيه فيديو
            // بدل الإرسال العادي اللي بيسيب الصفحة معلّقة طول مدة الرفع
            // ============================================================
            var form = imageInput.closest('form');
            var progressWrap = document.getElementById('event-upload-progress');
            var progressBar = document.getElementById('event-upload-progress-bar');
            var progressText = document.getElementById('event-upload-progress-text');
            var submitBtn = form ? form.querySelector('button[type="submit"]') : null;
            var submitOriginal = submitBtn ? submitBtn.textContent : 'حفظ';
            var uploading = false;

            // تحذير قبل إغلاق الصفحة أثناء الرفع عشان الرفع ميتقطعش بالغلط
            window.addEventListener('beforeunload', function(ev) {
                if (uploading) {
                    ev.preventDefault();
                    ev.returnValue = '';
                }
            });

            function failUpload(msg) {
                uploading = false;
                progressWrap.style.display = 'none';
                progressBar.style.width = '0';
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = submitOriginal;
                }
                hint.textContent = msg;
                hint.classList.add('ff-error');
                hint.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            // ============================================================
            // رفع مجزأ (chunked): الفيديو بيتقطع قطع صغيرة كل واحدة طلب
            // قصير مستقل، فمفيش مهلة سيرفر/CDN تقدر تقطع الرفع الطويل،
            // والقطعة اللي تفشل بتتعاد لوحدها من غير ما الرفع يبدأ من الأول.
            // ============================================================
            var CHUNK_SIZE = 4 * 1024 * 1024; // 4MB
            var CHUNK_URL = '{{ route('admin.upload.videoChunk') }}';

            function randomHex32() {
                var bytes = new Uint8Array(16);
                (window.crypto || window.msCrypto).getRandomValues(bytes);
                return Array.prototype.map.call(bytes, function(b) {
                    return ('0' + b.toString(16)).slice(-2);
                }).join('');
            }

            if (form) form.addEventListener('submit', function(e) {
                var file = videoInput.files && videoInput.files[0];
                // بدون فيديو (صورة أو مفيش ملف جديد) الإرسال العادي كافي وسريع
                if (!file) return;
                e.preventDefault();
                if (uploading) return;

                // فحص باقي الحقول الإجبارية قبل الرفع عشان منرفعش فيديو كبير وبعدها يفشل الحفظ
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                uploading = true;
                progressWrap.style.display = 'block';
                progressText.textContent = 'جاري رفع الفيديو...';
                hint.classList.remove('ff-error');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'جاري الرفع...';
                }

                var csrfInput = form.querySelector('input[name="_token"]');
                var csrf = csrfInput ? csrfInput.value : '';
                var uploadId = randomHex32();
                var total = Math.ceil(file.size / CHUNK_SIZE);

                function setProgress(loadedBytes) {
                    var pct = Math.min(99, Math.round((loadedBytes / file.size) * 100));
                    progressBar.style.width = pct + '%';
                    progressText.textContent = 'جاري رفع الفيديو... ' + pct + '% — من فضلك لا تغلق الصفحة';
                }

                function sendChunk(i, attempt) {
                    var start = i * CHUNK_SIZE;
                    var blob = file.slice(start, Math.min(start + CHUNK_SIZE, file.size));
                    var fd = new FormData();
                    fd.append('_token', csrf);
                    fd.append('upload_id', uploadId);
                    fd.append('index', i);
                    fd.append('total', total);
                    fd.append('chunk', blob, 'chunk.bin');

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', CHUNK_URL);
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.timeout = 120000; // دقيقتين للقطعة الواحدة (4MB) — أكثر من كافي

                    xhr.upload.onprogress = function(ev) {
                        if (ev.lengthComputable) setProgress(start + ev.loaded);
                    };

                    function retryOrFail(msg) {
                        if (attempt < 3) {
                            progressText.textContent = 'تقطّع الاتصال — إعادة محاولة الجزء ' + (i + 1) + ' من ' + total + '...';
                            setTimeout(function() { sendChunk(i, attempt + 1); }, 2000 * attempt);
                        } else {
                            failUpload(msg + ' حاول مرة أخرى.');
                        }
                    }

                    xhr.onload = function() {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            var res = {};
                            try { res = JSON.parse(xhr.responseText); } catch (err) {}
                            if (res.done && res.token) return submitWithToken(res.token);
                            if (i + 1 < total) return sendChunk(i + 1, 1);
                            failUpload('اكتمل الرفع لكن فشل تجميع الفيديو. حاول مرة أخرى.');
                        } else if (xhr.status === 422) {
                            var msg = 'ملف الفيديو مرفوض.';
                            try {
                                var res422 = JSON.parse(xhr.responseText);
                                msg = res422.message || msg;
                            } catch (err) {}
                            failUpload(msg);
                        } else if (xhr.status === 419) {
                            failUpload('انتهت الجلسة — حدّث الصفحة وسجّل الدخول ثم حاول مرة أخرى.');
                        } else {
                            retryOrFail('حصل خطأ أثناء الرفع (' + xhr.status + ').');
                        }
                    };
                    xhr.onerror = function() { retryOrFail('انقطع الاتصال أثناء الرفع.'); };
                    xhr.ontimeout = function() { retryOrFail('الاتصال بطيء جدًا.'); };

                    xhr.send(fd);
                }

                // بعد اكتمال كل القطع: نبعت الفورم نفسه من غير ملف الفيديو
                // (بياناته نصية خفيفة) ومعاه توكن الفيديو المتجمع على السيرفر
                function submitWithToken(token) {
                    progressBar.style.width = '100%';
                    progressText.textContent = 'تم رفع الفيديو — جاري الحفظ...';

                    videoInput.disabled = true;
                    var hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'video_token';
                    hidden.value = token;
                    form.appendChild(hidden);

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', form.getAttribute('action'));
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.setRequestHeader('Accept', 'application/json');

                    xhr.onload = function() {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            uploading = false;
                            progressText.textContent = 'تم الحفظ بنجاح ✓';
                            var res = {};
                            try { res = JSON.parse(xhr.responseText); } catch (err) {}
                            window.location.href = res.redirect || xhr.responseURL || window.location.href;
                        } else if (xhr.status === 422) {
                            // أخطاء الفاليديشن بترجع JSON بسبب هيدر Accept
                            var msg = 'برجاء مراجعة البيانات المدخلة.';
                            try {
                                var errs = JSON.parse(xhr.responseText).errors;
                                msg = Object.keys(errs).map(function(k) { return errs[k][0]; }).join(' — ');
                            } catch (err) {}
                            videoInput.disabled = false;
                            hidden.remove();
                            failUpload(msg);
                        } else {
                            videoInput.disabled = false;
                            hidden.remove();
                            failUpload('حصل خطأ أثناء الحفظ (' + xhr.status + '). حاول مرة أخرى.');
                        }
                    };
                    xhr.onerror = function() {
                        videoInput.disabled = false;
                        hidden.remove();
                        failUpload('انقطع الاتصال أثناء الحفظ. تأكد من الإنترنت وحاول مرة أخرى.');
                    };

                    xhr.send(new FormData(form));
                }

                sendChunk(0, 1);
            });
        })();
    });
</script>
