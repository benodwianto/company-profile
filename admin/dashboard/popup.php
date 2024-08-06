<style>
    /* Pop-up Message Styling */
    #popup-message {
        visibility: hidden;
        width: 300px;
        background-color: #4e0303;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 16px;
        position: fixed;
        z-index: 1000;
        left: 50%;
        top: 90%;
        /* Adjust this value to move the popup higher */
        transform: translate(-50%, -30%);
        /* Adjust this value to move the popup higher */
        font-size: 17px;
        box-shadow: 0 4px 8px rgba(68, 3, 3, 0.2);
    }

    #popup-message.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
</style>

<?php if (isset($_SESSION['message'])) : ?>
    <div id="popup-message" class="popup <?= htmlspecialchars($_SESSION['message_type']); ?>">
        <?= htmlspecialchars($_SESSION['message']); ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var popup = document.getElementById('popup-message');
            popup.classList.add('show');
            setTimeout(function() {
                popup.classList.remove('show');
                <?php unset($_SESSION['message']);
                unset($_SESSION['message_type']); ?>
            }, 3000);
        });
    </script>
<?php endif; ?>