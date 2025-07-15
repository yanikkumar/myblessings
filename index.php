<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Happy Blessings! GreatSite</title>
    <!-- Favicon as 🎂 emoji -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='0.9em' font-size='90'>🎂</text></svg>">
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
            z-index: 10;
        }

        .ribbon {
            font-size: 1.5rem;
            /* Slightly smaller ribbons */
        }

        html.overlay-active, body.overlay-active {
            overflow: hidden !important;
            height: 100vh !important;
            width: 100vw !important;
        }

        html, body {
            overflow: hidden !important;
            width: 100vw;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        /* Hide emojis when overlay is active */
        html.overlay-active .balloon, body.overlay-active .balloon {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-purple-400 to-pink-500 min-h-screen flex items-center justify-center">
    <!-- Start Overlay -->
    <div id="startOverlay" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 text-center animate-fadeIn">
        <button id="startButton" class="text-lg md:text-2xl font-bold px-6 py-4 md:px-10 md:py-6 rounded-2xl bg-white text-indigo-600 shadow-2xl max-w-[90vw] break-words transition hover:bg-indigo-50 active:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 animate-bounce">
            Click to Start the Blessing 🎶
        </button>
    </div>
    <!-- Background Music -->
    <audio id="bg-music" src="/audios/song.mp3" loop></audio>
    <!-- Pop Sound -->
    <audio id="pop-sound" src="/audios/balloon-pop.mp3"></audio>

    <div class="absolute top-4 right-4 z-20">
        <a href="https://github.com/yanikkumar/myblessings" target="_blank" rel="noopener noreferrer">
            <img src="https://img.shields.io/github/stars/yanikkumar/myblessings?style=social" alt="Star on GitHub">
        </a>
    </div>

    <!-- Blessing Card -->
    <div id="blessingCard" class="bg-white px-2 py-6 md:p-8 pb-24 rounded-3xl shadow-3xl text-center max-w-sm md:max-w-lg w-full mx-auto my-8 md:my-16 flex flex-col justify-center items-center animate-fadeIn border border-indigo-100 blur-sm transition-all duration-700">
        <?php
        date_default_timezone_set('Asia/Kolkata');
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

    <!-- Music Controls (outside card, always fixed to bottom center) -->
    <div id="musicControl" class="fixed bottom-4 left-1/2 -translate-x-1/2 z-[110] flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500">
        <button id="musicBtn" title="Pause Music" class="bg-white/90 rounded-full shadow-xl w-14 h-14 flex items-center justify-center cursor-pointer transition hover:bg-indigo-50 active:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 animate-fadeIn">
            <span id="musicIcon" class="text-2xl">⏸️</span>
        </button>
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
                // Always float within the viewport, but not at the extreme edges
                const vw = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
                const vh = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
                const margin = vw * 0.02; // 2% margin on each side
                emojiDiv.style.visibility = 'hidden';
                document.body.appendChild(emojiDiv);
                // Wait for DOM render, then measure and position
                requestAnimationFrame(() => {
                    const emojiWidth = emojiDiv.offsetWidth;
                    const maxLeft = Math.max(vw - margin - emojiWidth, margin);
                    const minLeft = margin;
                    const left = minLeft + Math.random() * (maxLeft - minLeft);
                    emojiDiv.style.left = left + 'px';
                    emojiDiv.style.bottom = '-50px';
                    emojiDiv.style.visibility = 'visible';
                });
                // Pop animation
                anime({
                    targets: emojiDiv,
                    scale: [0, 1.2, 1],
                    opacity: [0, 1],
                    duration: 400,
                    easing: 'easeOutElastic(1, .8)'
                });
                // Allow user to pop emoji by clicking
                emojiDiv.style.cursor = 'pointer';
                emojiDiv.addEventListener('click', function popEmoji() {
                    // Play pop sound only on click
                    if (audioStarted) {
                        const popSound = new Audio('/audios/balloon-pop.mp3');
                        popSound.volume = 0.8;
                        popSound.play();
                    }
                    // Pop-out animation
                    anime({
                        targets: emojiDiv,
                        scale: [1, 1.4, 0],
                        opacity: [1, 0],
                        duration: 400,
                        easing: 'easeInBack',
                        complete: function () {
                            emojiDiv.remove();
                        }
                    });
                    emojiDiv.removeEventListener('click', popEmoji);
                });
                anime({
                    targets: emojiDiv,
                    translateY: -vh,
                    duration: Math.random() * 5000 + 3000,
                    easing: 'linear',
                    complete: function () {
                        emojiDiv.remove();
                    }
                });
            }

            // Only regular floating animation
            setInterval(createAnimation, 300);

            // Start overlay logic
            const startOverlay = document.getElementById('startOverlay');
            const startButton = document.getElementById('startButton');
            const bgMusic = document.getElementById('bg-music');
            let audioStarted = false;
            function startAudio() {
                if (!audioStarted) {
                    bgMusic.volume = 1.0;
                    bgMusic.currentTime = 0;
                    bgMusic.play();
                    audioStarted = true;
                    setTimeout(updateMusicButton, 100);
                }
            }
            // Prevent scroll/flash when overlay is active
            document.documentElement.classList.add('overlay-active');
            document.body.classList.add('overlay-active');
            const blessingCard = document.getElementById('blessingCard');
            function hideOverlayAndStart() {
                startOverlay.style.display = 'none';
                startAudio();
                document.documentElement.classList.remove('overlay-active');
                document.body.classList.remove('overlay-active');
                // Unblur the blessing card
                blessingCard.classList.remove('blur-sm');
                blessingCard.classList.add('blur-0');
                // Show the music control button
                const musicControl = document.getElementById('musicControl');
                musicControl.classList.remove('opacity-0', 'pointer-events-none');
                musicControl.classList.add('opacity-100');
            }
            startButton.addEventListener('click', hideOverlayAndStart);
            // Also allow clicking anywhere to start
            startOverlay.addEventListener('click', hideOverlayAndStart);

            // Hide music control initially
            const musicControl = document.getElementById('musicControl');
            musicControl.classList.add('opacity-0', 'pointer-events-none');

            const musicBtn = document.getElementById('musicBtn');
            const musicIcon = document.getElementById('musicIcon');
            function updateMusicButton() {
                if (bgMusic.ended) {
                    musicIcon.textContent = '🔁';
                    musicBtn.title = 'Replay Music';
                } else if (bgMusic.paused) {
                    musicIcon.textContent = '▶️';
                    musicBtn.title = 'Play Music';
                } else {
                    musicIcon.textContent = '⏸️';
                    musicBtn.title = 'Pause Music';
                }
            }
            musicBtn.addEventListener('click', function() {
                if (bgMusic.ended) {
                    bgMusic.currentTime = 0;
                    bgMusic.play();
                } else if (bgMusic.paused) {
                    bgMusic.play();
                } else {
                    bgMusic.pause();
                }
                setTimeout(updateMusicButton, 100);
            });
            bgMusic.addEventListener('play', updateMusicButton);
            bgMusic.addEventListener('pause', updateMusicButton);
            bgMusic.addEventListener('ended', updateMusicButton);
        });
    </script>

</body>

</html>