<style>
    .button {
        position: absolute;
        right: 10px;
        bottom: 10px;
        padding: 8px 18px;
        background-color: transparent;
        border: none;
        color: var(--action);
        border-radius: 50px;
        overflow: hidden;
        z-index: 1;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 6px 10px rgba(184, 183, 183, 0.1);
        cursor: pointer;
    }

    .button:hover {
        transform: scale(1.05);
        color: #fff;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .button:active {
        transform: scale(0.9);
    }

    .button::before {
        content: "";
        position: absolute;
        top: 0;
        right: -100%;
        width: 100%;
        height: 100%;
        background-color: var(--action);
        transition: all 0.4s ease-in-out;
        z-index: -1;
        border-radius: 50px;
    }

    .button:hover::before {
        right: 0;
    }
</style>
<button class="button">
    Start <i class="fa-duotone fa-arrow-right"></i>
</button>
