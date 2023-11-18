<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="فهيم AI Team" name="author">
    <meta content="خاصية البحث العكسي في معجم الرياض، بحيث يتاح للمستخدم إدخال وصف للكلمة أو شرحها أو معناها، ويقوم نموذج الذكاء الاصطناعي باقتراح عدد من المفردات التي تؤدي نفس المعنى في الوصف، بالإضافة إلى توليد صورة لهذه المفردة" name="description">
    <meta content="ai,image,description,meaning,words,dictionary" name="keywords">

    <title>فهيم</title>
    <!-- Favicons -->
    <link href="{{ asset("img/logo.png") }}" rel="icon">
    <link href="{{ asset("img/logo.png") }}" rel="apple-touch-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset("img/apple-touch-icon.png") }}" rel="apple-touch-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("css/chat.css") }}">
</head>
<body>
    <section class="msger">
        <div class="loader-wrapper d-flex flex-row justify-content-center align-items-center rounded">
            <span class="loader"></span>
        </div>
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i>
                فهيم AI
            </div>
            <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
            </div>
        </header>
        <main class="msger-chat">
            <div class="msg left-msg">
                <div
                    class="msg-img"
                    style="background-image: url('https://cdn-icons-png.flaticon.com/512/2068/2068868.png'); background-position: center; background-size: 60%;"
                ></div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">
                            <small>
                                فهيم AI
                            </small>
                        </div>
                        <div class="msg-info-time">
                            <small class="text-muted">
                                {{ date("H:i") }}
                            </small>
                        </div>
                    </div>
                    <div class="msg-text">
                        اهلاً وسهلاً بك عزيزي، صف لي كلمة
                    </div>
                </div>
            </div>
        </main>
        <div class="msger-inputarea">
            <input type="text" class="msger-input" placeholder="قم بكتابة وصفك هنا">
            <button type="button" class="msger-send-btn">إرسال</button>
        </div>
    </section>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #52CBBE;padding-bottom: 10px;padding-top: 10px;">
                    <h5 class="modal-title m-0" id="staticBackdropLabel">
                        معلومات المستخدم
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="username">اسم المستخدم</label>
                        <input class="form-control" id="username" placeholder="اسم المستخدم" aria-label="اسم المستخدم">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="login-btn" class="btn btn-custom text-white">دخول</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset("js/chat.js") }}"></script>
</body>
</html>
