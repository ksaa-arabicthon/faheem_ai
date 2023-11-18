$(function () {
    let isLoggedIn = false;
    let PERSON_NAME = "زائر";
    $("#login-btn").on("click", function () {
        let username = $("#username").val();
        if ( username.length < 1 ) {
            alert("من فضلك قم بإدخال اسم المستخدم");
            return;
        }
        if ( username.length > 15 ) {
            alert("طول اسم المستخدم يجب ان يكون اقل من ١٥");
            return;
        }
        isLoggedIn = true;
        PERSON_NAME = username;
        $("#staticBackdrop").modal("hide");
    });

    setInterval(function () {
        if ( !isLoggedIn ) {
            $("#staticBackdrop").modal("show");
        }
    }, 1);


    const msgerForm = get(".msger-inputarea");
    const msgerInput = get(".msger-input");
    const msgerChat = get(".msger-chat");

    // Icons made by Freepik from www.flaticon.com
    const BOT_IMG = "https://cdn-icons-png.flaticon.com/512/2068/2068868.png";
    const PERSON_IMG = "https://cdn-icons-png.flaticon.com/128/1077/1077114.png";
    const BOT_NAME = "فهيم AI";


    $(".msger-input").on("keypress", async function (event) {
        if (event.key === "Enter") {
            $(".msger-send-btn").trigger("click");
        }
        return true;
    });

    $(".msger-send-btn").on("click", async function (event) {
        event.preventDefault();
        let messageInput = $(".msger-input");
        if ( messageInput.val().length === 0 ) {
            return;
        }

        showLoader();
        appendMessage(PERSON_NAME, PERSON_IMG, "right", messageInput.val(), null, "user");
        let message = messageInput.val();
        messageInput.val("");
        let response = await sendMessage(message);
        console.log(response);
        handleAiResponse(response);
        hideLoader();
    });

    function appendMessage(name, img, side, text, image = null, sender, type = "normal") {
        //   Simple solution for small apps
        const msgHTML = `
    <div class="msg ${side}-msg">
      <div class="msg-img" style="background-image: url(${img})"></div>

      <div class="msg-bubble">
        <div class="msg-info">
          <div class="msg-info-name"><small>${name}</small></div>
          <div class="msg-info-time"><small class="${sender === "user" ? 'text-white': 'text-muted'}">${formatDate(new Date())}</small></div>
        </div>

        <div class="msg-text">${text}</div>
      </div>
    </div>
    ${type === "normal" && sender === "ai" ? `<div class="generated-image-view rounded" style="background-image: url('${image}')"></div>`: ''}`;
        msgerChat.insertAdjacentHTML("beforeend", msgHTML);
        msgerChat.scrollTop += 500;
    }

    function handleAiResponse(data) {
        if ( data["status"] === "success" ) {
            appendMessage(BOT_NAME, BOT_IMG, "left", data["data"]["message"], data["data"]["image"],  "ai");
        } else {
            appendMessage(BOT_NAME, BOT_IMG, "left", data["message"], null, "ai", "error");
        }
    }

    // Utils
    function get(selector, root = document) {
        return root.querySelector(selector);
    }

    function formatDate(date) {
        const h = "0" + date.getHours();
        const m = "0" + date.getMinutes();

        return `${h.slice(-2)}:${m.slice(-2)}`;
    }

    function random(min, max) {
        return Math.floor(Math.random() * (max - min) + min);
    }

    async function sendMessage(message) {
        let data = {
            message
        };
        let response = fetch("{{ route('chat.word_description') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                'Accept': "application/json",
                'Content-Type': "application/json",
            },
            body: JSON.stringify(data)
        });
        return await (await response).json();
    }

    function showLoader() {
        disableAll();
        $(".loader-wrapper").animate({zIndex: 999999});
    }

    function hideLoader() {
        enableAll();
        $(".loader-wrapper").animate({zIndex: -1});
    }

    function disableAll() {
        $("button input").prop({disabled: true});
    }

    function enableAll() {
        $("button input").prop({disabled: false});
    }
});
