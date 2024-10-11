@extends('app')

@section('content')
<header class="py-5">
    <div class="container px-lg-5">
        <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-5">
                <h1 class="display-5 fw-bold">Video Tracker (SCORM)</h1>
                <p class="fs-4">Track video progress and resume where you left off.</p>
                <p class="fs-5"><a href="{{ route('videos') }}">Locally Stored</a></p>
            </div>
        </div>
    </div>
</header>

<div class="container">

    <form method="POST" action="{{ route('storeUserData') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <button type="submit">Start Video</button>
    </form>

    <section class="pt-4">
        <div class="container px-lg-5">
            <div class="row gx-lg-5">
                <!-- Video 1 -->
                <div class="col-12 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <h2 class="fs-4 fw-bold">Video 1</h2>
                            <iframe 
                                id="iframe1" 
                                src="https://app.cloud.scorm.com/sc/InvitationConfirmEmail?publicInvitationId=04acd272-2bde-403b-942f-dfe83acbfa5f" 
                                width="100%" 
                                height="400" 
                                frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <!-- Video 2 -->
                <div class="col-12 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <h2 class="fs-4 fw-bold">Video 2</h2>
                            <iframe 
                                id="iframe2" 
                                src="https://app.cloud.scorm.com/sc/InvitationConfirmEmail?publicInvitationId=b8bdcb40-0555-403f-b11e-20c3910fd298" 
                                width="100%" 
                                height="400" 
                                frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
                <!-- Video 3 -->
                <div class="col-12 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <h2 class="fs-4 fw-bold">Video 3</h2>
                            <iframe 
                                id="iframe3" 
                                src="https://app.cloud.scorm.com/sc/InvitationConfirmEmail?publicInvitationId=93331c1b-86e1-4100-9703-13fa4e6b8705" 
                                width="100%" 
                                height="400" 
                                frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const videos = [
                { id: "iframe1", duration: 0 },
                { id: "iframe2", duration: 0 },
                { id: "iframe3", duration: 0 }
            ];

            videos.forEach(video => {
                const iframe = document.getElementById(video.id);
                const storedTime = localStorage.getItem(video.id) || 0;
                iframe.contentWindow.postMessage({ action: "seek", time: storedTime }, "*");

                iframe.addEventListener("load", function() {
                    const interval = setInterval(() => {
                        iframe.contentWindow.postMessage({ action: "getCurrentTime" }, "*");
                    }, 1000);

                    window.addEventListener("message", function(event) {
                        if (event.origin !== "https://app.cloud.scorm.com") return;
                        if (event.data.action === "currentTime") {
                            video.duration = event.data.time;
                            localStorage.setItem(video.id, video.duration);
                        }
                    });

                    window.addEventListener("beforeunload", function() {
                        clearInterval(interval);
                    });
                });
            });
        });
    </script>
</div>

@endsection
