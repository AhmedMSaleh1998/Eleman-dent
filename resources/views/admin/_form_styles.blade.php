<style>
    .ff-wrap {
        direction: rtl;
        width: 100%;
        font-size: 14px;
    }

    .ff-note {
        background: #fdf3f2;
        border: 1px solid #f5c6cb;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        margin-bottom: 18px;
    }

    .ff-card {
        background: #fff;
        border: 1px solid #e3e8ee;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(20, 40, 60, 0.05);
    }

    .ff-card__head {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f7f9fb;
        border-bottom: 1px solid #e3e8ee;
        padding: 13px 20px;
        font-size: 15px;
        font-weight: 700;
        color: #2d3b48;
    }

    .ff-card__head i {
        color: #1abc9c;
        font-size: 16px;
    }

    .ff-card__head small {
        font-weight: 400;
        color: #8a97a3;
        margin-right: auto;
        font-size: 12px;
    }

    .ff-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px 22px;
        padding: 20px;
    }

    .ff-field--full {
        grid-column: 1 / -1;
    }

    .ff-field label {
        display: block;
        font-weight: 600;
        color: #34424e;
        margin-bottom: 7px;
    }

    .ff-field .req {
        color: #e74c3c;
        font-weight: 700;
    }

    .ff-field .opt {
        color: #8a97a3;
        font-weight: 400;
        font-size: 12px;
    }

    .ff-input {
        display: block;
        width: 100%;
        border: 1px solid #d9e1e8;
        border-radius: 8px;
        padding: 10px 14px;
        background: #fff;
        color: #2d3b48;
        transition: border-color 0.2s, box-shadow 0.2s;
        height: auto;
    }

    .ff-input::placeholder {
        color: #aab6c0;
        font-size: 12.5px;
    }

    .ff-input:focus {
        border-color: #1abc9c;
        box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.15);
        outline: none;
    }

    select.ff-input {
        cursor: pointer;
    }

    .ff-error {
        display: block;
        color: #e74c3c;
        font-size: 12.5px;
        margin-top: 5px;
    }

    .ff-current-img {
        margin-top: 10px;
        width: 90px;
        height: 90px;
        object-fit: contain;
        border: 1px solid #e3e8ee;
        border-radius: 8px;
        background: #fff;
        padding: 6px;
    }

    .ff-actions {
        text-align: center;
        padding: 6px 0 30px;
    }

    .ff-submit {
        background: #1abc9c;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 70px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
    }

    .ff-submit:hover {
        background: #159c82;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .ff-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
