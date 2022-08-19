$(document).ready(function () {
    let preview = document.getElementById("preview");
    let recording = document.getElementById("recording");
    let startButton = document.getElementById("startRecord");
    let stopButton = document.getElementById("stopRecord");
    $('#saveRecord').attr('disabled', 'disabled')
    let recordingTimeMS = 16000;
    let formData = new FormData();
    let start = 0;
    startButton.addEventListener("click", () => {
        start = 0;
        startButton.style.display = 'none';
        stopButton.style.display = 'block';
        setTimeout(() => {
            window.recordDuration = setInterval(function () {
                start++;
                $('#duration').val(start);
            }, 1000)
        }, 600)

        navigator.mediaDevices.getUserMedia({
            video: true,
            audio: true
        }).then((stream) => {
            preview.srcObject = stream;
            preview.captureStream = preview.captureStream || preview.mozCaptureStream;
            return new Promise((resolve) => preview.onplaying = resolve);
        }).then(() => startRecording(preview.captureStream(), recordingTimeMS))
            .then((recordedChunks) => {
                let recordedBlob = new Blob(recordedChunks, {type: 'video/webm'});
                let recordedFile = new File([recordedBlob], 'record', {type: 'video/webm'});
                formData.append('record', recordedFile);
                recording.src = URL.createObjectURL(recordedBlob);
                $('#saveRecord').removeAttr('disabled');
            }).catch((error) => {
            if (error.name === "NotFoundError") {
                alert("Camera or microphone not found. Can't record.")
            }
        });
    }, false);

    stopButton.addEventListener("click", () => {
        startButton.style.display = 'block';
        stopButton.style.display = 'none';
        stop(preview.srcObject);
        clearInterval(window.recordDuration);
    }, false);

    const wait = (delayInMS) => new Promise((resolve) => setTimeout(resolve, delayInMS));

    const stop = (stream) => stream.getTracks().forEach((track) => track.stop());

    const startRecording = (stream, lengthInMS) => {
        let recorder = new MediaRecorder(stream);
        let data = [];

        recorder.ondataavailable = (event) => data.push(event.data);
        recorder.start();

        let stopped = new Promise((resolve, reject) => {
            recorder.onstop = resolve;
            recorder.onerror = (event) => reject(event.name);
        });

        let recorded = wait(lengthInMS).then(() => {
                if (recorder.state === "recording") {
                    startButton.style.display = 'block';
                    stopButton.style.display = 'none';
                    recorder.stop();
                }
            },
        );

        return Promise.all([
            stopped,
            recorded
        ]).then(() => data);
    }


    $('#saveRecord').on('click', (e) => {
        formData.append('message', $('#message').val())
        formData.append('duration', $('#duration').val())
        $.ajax({
            url: "/record",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content'),
            },
            processData: false,
            contentType: false,
            success: (r) => {
                alert(r.message);
                setTimeout(() => {
                    window.location.href = r.redirect
                }, 1500)
            },
            error: (e) => {
                let {message} = e.responseJSON;
                if (message !== undefined) {
                    $('#recordError').show()
                    $('#recordErrorText').text(message);
                }
            }
        });
    })

})
