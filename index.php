<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Happy Blessings! GreatSite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        .balloon {
            position: absolute;
            pointer-events: none;
            font-size: 3rem;
            /* Adjust size as needed */
        }

        .ribbon {
            font-size: 1.5rem;
            /* Slightly smaller ribbons */
        }

        html, body {
            overflow: hidden !important;
            width: 100vw;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-purple-400 to-pink-500 min-h-screen flex items-center justify-center">
    <!-- Start Overlay -->
    <div id="startOverlay" style="position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.7);display:flex;align-items:center;justify-content:center;">
        <button id="startButton" style="font-size:2rem;padding:1.5rem 3rem;border-radius:1rem;background:#fff;color:#7c3aed;font-weight:bold;box-shadow:0 2px 16px #0002;cursor:pointer;">Click to Start the Blessing 🎶</button>
    </div>
    <!-- Background Music -->
    <audio id="bg-music" src="https://cdn.pixabay.com/audio/2022/10/16/audio_12b6fae5b6.mp3" loop></audio>
    <!-- Pop Sound -->
    <audio id="pop-sound" src="https://cdn.pixabay.com/audio/2022/03/15/audio_115b9b7bfa.mp3"></audio>

    <div class="absolute top-4 right-4 z-20">
        <a href="https://github.com/yanikkumar/myblessings" target="_blank" rel="noopener noreferrer">
            <img src="https://img.shields.io/github/stars/yanikkumar/myblessings?style=social" alt="Star on GitHub">
        </a>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-2xl text-center max-w-md w-full fade-in">
        <?php
        function wishes_celebration($name, $sendersName = "Anonymous", $date = null, $wishType = "anniversary")
        {
            $heading = ($wishType == "birthday") ? "🎉 Happy Birthday, " : "🎉 Happy Anniversary, ";
            echo "<h1 class='text-3xl font-bold text-indigo-600 mb-4'>" . htmlspecialchars($heading) . htmlspecialchars($name) . "! 🎂</h1>";

            $wishes = ($wishType == "birthday") ?
                ["Happiness 😃", "Health 😇", "Success 💫 ", "Joy 😂", "Love 💖", "Positivity 🤩"] :
                ["Love 🧑🏻‍❤️‍👩🏻", "Joy 😃", "Peace 🕊️", "Togetherness 👩🏻‍🤝‍👨🏻", "Prosperity 🤗", "Growth 🪴"];
            foreach ($wishes as $index => $wish) {
                echo "<p class='text-lg text-gray-700 mb-2' id='wish-" . $index . "'>✨ Sending " . htmlspecialchars($wish) . " your way...</p>";
            }

            $message = ($wishType == "birthday") ?
                "May your heart's deepest desires blossom into reality, and every dream you chase fill you with breathtaking joy." :
                "May your journey of love continue to deepen, and may each day be a celebration of your togetherness.";
            echo "<p class='text-xl text-green-600 mt-6'>" . htmlspecialchars($message) . "</p>";
            echo "<p class='text-lg mt-4'>With Love From " . htmlspecialchars($sendersName) . "</p>";

            if ($date) {
                $today = new DateTime('today');
                // Handle partial dates
                $date = trim($date);
                if (preg_match('/^\\d{4}-\\d{2}-\\d{2}$/', $date)) {
                    // Full date, do nothing
                } elseif (preg_match('/^\\d{4}-\\d{2}$/', $date)) {
                    // Year and month only, set to last day of month
                    $date .= '-' . date('t', strtotime($date . '-01'));
                } elseif (preg_match('/^\\d{4}$/', $date)) {
                    // Year only, set to last day of year
                    $date .= '-12-31';
                }
                if ($wishType == "birthday") {
                    $birthDate = new DateTime($date);
                    $age = $birthDate->diff($today)->y;
                    $sarcasticMessage = getSarcasticMessage($age, $wishType);
                    echo "<p class='text-lg mt-4'>" . htmlspecialchars($sarcasticMessage) . "</p>";
                } else {
                    $anniversaryDate = new DateTime($date);
                    $years = $anniversaryDate->diff($today)->y;
                    $sarcasticMessage = getSarcasticMessage($years, $wishType);
                    echo "<p class='text-lg mt-4'>Happy " . $years . "-year Anniversary!  <br/>" . htmlspecialchars($sarcasticMessage) . "<br/> (Just kidding, you are 🥵🔥 couple.)</p>";
                }
            }
        }

        function getSarcasticMessage($years, $wishType)
        {
            if ($wishType == "birthday") {
                return "You are " . $years . " years old today, so grown up, you're practically vintage! (Just kidding, you're timeless.)";
            }
            $messages = [
                1 => "So, you've survived year 1?  That's...a start.",
                5 => "{$years} years?  Wow, that's almost a respectable amount of time.",
                10 => "{$years} years!  You've unlocked the 'Endurance' achievement.",
                20 => "{$years} years...are you sure you still like each other?",
                30 => "{$years} years!  An inspiration to us all...or a sign of stubbornness.",
                40 => "{$years} Years! You Deserve a Medal... or maybe just a really long vacation from each other.",
                50 => "{$years} Years! Okay, now you're just showing off.",
                "default" => "Another year, another excuse for cake. Congrats.",
            ];

            if (array_key_exists($years, $messages)) {
                return $messages[$years];
            } elseif ($years > 50) {
                return "You two should write a book...or at least give a TED Talk.";
            } elseif ($years > 40) {
                return "Still going strong, or just too stubborn to quit?";
            } elseif ($years > 30) {
                return "You've officially been together longer than some countries have existed.";
            } elseif ($years > 20) {
                return "Is this true love, or just a really long negotiation?";
            } elseif ($years > 10) {
                return "You're halfway to a golden anniversary...keep it up!";
            } elseif ($years > 5) {
                return "Not bad, Hope you're not tired of each other yet!";
            } elseif ($years > 1) {
                return "Well, you've made it past the honeymoon phase, at least.";
            } else {
                // Fallback
                return "You just started your horry story. Congrats.";
            }
        }

        $name = isset($_GET['name']) ? $_GET['name'] : 'Guest';
        $sendersName = isset($_GET['sender']) ? $_GET['sender'] : "Anonymous";
        $date = isset($_GET['date']) ? $_GET['date'] : null;
        $wishType = isset($_GET['wishing']) ? $_GET['wishing'] : 'anniversary';
        wishes_celebration($name, $sendersName, $date, $wishType);

        ?>
        <hr class="mt-3" />
        <footer class="text-center p-4 text-sky-600">
            <p class='text-xs font-light'>Created By <a href='https://youtube.com/yanikkumarvlogs?sub_confirmation=1'
                    class='text-red-400 font-semibold'>Yanik Kumar</a></p>
            &copy; <?php echo date("Y"); ?> <a href="https://myblessings.great-site.net"
                class="font-light text-xs">MyBlessings.GreatSite</a></br>
            <a href="https://github.com/yanikkumar" class="font-light text-xs">Believe Master - Create Innovate Inspire
                & Serve</a>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const wishes = document.querySelectorAll('[id^="wish-"]');
            wishes.forEach((wish, index) => {
                anime({
                    targets: wish,
                    translateY: [-20, 0],
                    opacity: [0, 1],
                    duration: 800,
                    delay: index * 200,
                    easing: 'easeOutExpo'
                });
            });

            anime({
                targets: 'h1',
                scale: [0.8, 1],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutElastic(1, .8)'
            })

            anime({
                targets: '.bg-white',
                scale: [0.9, 1],
                duration: 1200,
                easing: 'easeOutElastic(1, .8)'
            })

            const allEmojis = ['💖', '🤩', '🎈', '🥂', '🎀', '🥰', '💗', '✨', '😊', '🥳', '❤️', '💞', '💝', '🎉'];

            //Emoji Animation
            function createAnimation() {
                const emojiDiv = document.createElement('div');
                emojiDiv.classList.add('balloon');

                const randomEmoji = allEmojis[Math.floor(Math.random() * allEmojis.length)];
                emojiDiv.textContent = randomEmoji;

                emojiDiv.style.left = Math.random() * window.innerWidth + 'px';
                emojiDiv.style.bottom = '-50px';
                document.body.appendChild(emojiDiv);

                // Pop animation
                anime({
                    targets: emojiDiv,
                    scale: [0, 1.2, 1],
                    opacity: [0, 1],
                    duration: 400,
                    easing: 'easeOutElastic(1, .8)'
                });
                // Play pop sound
                const popSound = document.getElementById('pop-sound');
                if (popSound) {
                    popSound.currentTime = 0;
                    popSound.play();
                }

                anime({
                    targets: emojiDiv,
                    translateY: -window.innerHeight,
                    duration: Math.random() * 5000 + 3000,
                    easing: 'linear',
                    complete: function () {
                        emojiDiv.remove();
                    }
                });
            }

            // Initial burst of emojis
            for (let i = 0; i < 50; i++) {
                setTimeout(createAnimation, i * 50); // 50 emojis, 50ms apart
            }

            // Then continue at normal pace
            setTimeout(() => {
                setInterval(createAnimation, 300);
            }, 30 * 50);

            // Start overlay logic
            const startOverlay = document.getElementById('startOverlay');
            const startButton = document.getElementById('startButton');
            const bgMusic = document.getElementById('bg-music');
            let audioStarted = false;
            function startAudio() {
                if (!audioStarted) {
                    bgMusic.volume = 0.5;
                    bgMusic.play();
                    audioStarted = true;
                }
            }
            function hideOverlayAndStart() {
                startOverlay.style.display = 'none';
                startAudio();
            }
            startButton.addEventListener('click', hideOverlayAndStart);
            // Also allow clicking anywhere to start
            startOverlay.addEventListener('click', hideOverlayAndStart);
        });
    </script>

</body>

</html>