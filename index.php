<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Birthday! YourGreatSite</title>
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
    </style>
</head>

<body class="bg-gradient-to-r from-purple-400 to-pink-500 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-2xl text-center max-w-md w-full fade-in">
        <?php
        // https://yourbirthday.great-site.net/?name=Yanik&sender=Believe+Master&dob=1998-03-21
        function birthday_celebration($name, $sendersName, $dob = null)
        {
            echo "<h1 class='text-3xl font-bold text-indigo-600 mb-4'>🎉 Happy Birthday, " . htmlspecialchars($name) . "!<br/> 🎂</h1>";
            $wishes = ["Happiness 😃", "Health 😇", "Success 💫 ", "Joy 😂", "Love 💖", "Positivity 🤩"];
            foreach ($wishes as $index => $wish) {
                echo "<p class='text-lg text-gray-700 mb-2' id='wish-" . $index . "'>✨ Sending " . htmlspecialchars($wish) . " your way...</p>"; //replaced computer emoji with sparkles
            }
            echo "<p class='text-xl text-green-600 mt-6 font-semibold'>🪄 May your heart's deepest desires blossom into reality, and every dream you chase fill you with breathtaking joy.</p><hr class='my-4'/>"; //Replaced line.
            if ($dob) {
                $birthDate = new DateTime($dob);
                $today = new DateTime('today');
                $age = $birthDate->diff($today)->y;
                echo "<p class='text-lg mt-4 italic'>You are " . $age . " years old today, so grown up, you're practically vintage! 😂<br/> (Just kidding, you're timeless 😉)</p>";
            }
            echo "<p class='text-md mt-4'>With 🥰 From " . htmlspecialchars($sendersName) . "</p><hr class='my-4'/>"; // added the dynamic line
        
            echo "<p class='text-xs font-light'>Created By Believe Master - Create, Innovate, Inspire & Serve</p>";
        }

        $name = isset($_GET['name']) ? $_GET['name'] : 'Guest';
        $sendersName = isset($_GET['sender']) ? $_GET['sender'] : "Your Friend";
        $dob = isset($_GET['dob']) ? $_GET['dob'] : null;
        birthday_celebration($name, $sendersName, $dob);
        ?>
        <footer class="text-center p-4 text-sky-600">
            &copy; <?php echo date("Y"); ?> <a href="https://feedinweb.com" class="font-light text-xs">FeedinWeb</a>
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

            //Balloon Animation
            function createBalloon() {
                const balloon = document.createElement('div');
                balloon.classList.add('balloon');
                balloon.textContent = '🎈'; // Balloon Emoji
                balloon.style.left = Math.random() * window.innerWidth + 'px';
                balloon.style.bottom = '-50px';
                document.body.appendChild(balloon);

                anime({
                    targets: balloon,
                    translateY: -window.innerHeight,
                    duration: Math.random() * 5000 + 3000,
                    easing: 'linear',
                    complete: function () {
                        balloon.remove();
                    }
                });
            }

            setInterval(createBalloon, 1000);
        });
    </script>

</body>

</html>