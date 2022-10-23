<!DOCTYPE html>
<html>
<title><?= $title ?></title>
<link rel="icon" href="<?= base_url('asset/homepage/img'); ?>/logo.png" type="image/gif">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
    body,
    h1 {
        font-family: "Raleway", sans-serif
    }

    body,
    html {
        height: 100%
    }

    .bgimg {
        background-image: url("<?= base_url('asset/homepage/img/underconstruction.jpg'); ?>");
        min-height: 100%;
        background-position: center;
        background-size: cover;
    }
</style>

<body>

    <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
        <div class="w3-display-topleft w3-padding-large w3-xlarge">
            <a class="navbar-brand logo" href="<?= base_url(''); ?>"><img src="<?= base_url('asset/homepage/img'); ?>/logo-2.png" alt="" width="150px"></a>
        </div>
        <div class="w3-display-middle">
            <h1 class="w3-jumbo w3-animate-top" style="white-space:nowrap;"><span class="w3-center w3-padding-large w3-black w3-xxlarge w3-wide w3-animate-opacity"><?= $message ?></span></h1>
            <hr class="w3-border-grey" style="margin:auto;width:40%">
            <p id="countdown" class="w3-large w3-center"></p>
        </div>
        <div class="w3-display-bottomright w3-padding-large">Photo by <a href="https://unsplash.com/@shivendushukla?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Shivendu Shukla</a> on <a href="https://unsplash.com/?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a></div>
    </div>

    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?= $deadline_time ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in an element with id="countdown"
            document.getElementById("countdown").innerHTML = days + " Hari " + hours + " Jam " +
                minutes + " Menit " + seconds + " Detik ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>

</body>

</html>