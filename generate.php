<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate My Happy Blessings | Greatsite</title>
    <!-- Favicon as 🎂 emoji -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='0.9em' font-size='90'>🎂</text></svg>">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-purple-400 to-pink-500 bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="absolute top-4 right-4 z-20">
        <a href="https://github.com/yanikkumar/myblessings" target="_blank" rel="noopener noreferrer">
            <img src="https://img.shields.io/github/stars/yanikkumar/myblessings?style=social" alt="Star on GitHub">
        </a>
    </div>
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-4 text-center text-indigo-600">Generate Blessings</h2>
        <form id="blessingsForm">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Wish Type:</label>
                <div class="flex items-center">
                    <input type="radio" id="anniversary" name="wishType" value="anniversary" class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                    <label for="anniversary" class="text-gray-700 text-sm font-medium">Anniversary</label>
                </div>
                <div class="flex items-center mb-2">
                    <input type="radio" id="birthday" name="wishType" value="birthday" class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="birthday" class="text-gray-700 text-sm font-medium">Birthday</label>
                </div>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Recipient's Name:</label>
                <input type="text" id="name" name="name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p id="nameError" class="text-red-500 text-xs italic mt-1" style="display: none;"></p>
            </div>
            <div class="mb-4">
                <label for="sender" class="block text-gray-700 text-sm font-bold mb-2">Sender's Name (Optional):</label>
                <input type="text" id="sender" name="sender"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Date Type:</label>
                <div class="flex items-center mb-2">
                    <input type="radio" id="dateTypeFull" name="dateType" value="full" class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                    <label for="dateTypeFull" class="text-gray-700 text-sm font-medium">Full Date (DD-MM-YYYY)</label>
                </div>
                <div class="flex items-center mb-2">
                    <input type="radio" id="dateTypeMonth" name="dateType" value="month" class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="dateTypeMonth" class="text-gray-700 text-sm font-medium">Month & Year (MM-YYYY)</label>
                </div>
            </div>
            <div class="mb-4" id="dateFullDiv">
                <label for="dateFull" class="block text-gray-700 text-sm font-bold mb-2">Full Date of Anniversary/Birthday (Optional):</label>
                <input type="date" id="dateFull" name="dateFull"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4" id="dateMonthDiv" style="display:none;">
                <label for="dateMonth" class="block text-gray-700 text-sm font-bold mb-2">Month & Year of Anniversary/Birthday (Optional):</label>
                <input type="month" id="dateMonth" name="dateMonth"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="button" onclick="validateAndGenerate()"
                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Generate</button>
        </form>
        <div id="linkContainer" class="mt-6 text-center" style="display: none;">
            <p class="text-gray-700 font-semibold">Copy the text below to share:</p>
            <div class="mt-2 border rounded p-2 bg-gray-100">
                <textarea id="shareText"
                    class="w-full text-sm text-gray-600 bg-transparent border-none focus:outline-none" rows="2"
                    readonly></textarea>
            </div>
            <button onclick="copyShareText()"
                class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Copy
                Message</button>
        </div>
        <hr class="mt-4" />
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
        const nameInput = document.getElementById('name');
        const nameError = document.getElementById('nameError');
        const wishTypeBirthday = document.getElementById('birthday');
        const wishTypeAnniversary = document.getElementById('anniversary');
        const dateLabel = document.getElementById('dateLabel');
        const linkContainer = document.getElementById('linkContainer');
        const shareTextInput = document.getElementById('shareText');

        function validateAndGenerate() {
            if (nameInput.value.trim() === '') {
                nameError.textContent = "Recipient's name is required";
                nameError.style.display = 'block';
                return;
            } else {
                nameError.style.display = 'none';
                generateLink();
            }
        }

        linkContainer.style.display = 'none'; // Hide initially

        function generateLink() {
            const name = document.getElementById('name').value;
            const sender = document.getElementById('sender').value;
            const wishType = document.querySelector('input[name="wishType"]:checked').value;
            const dateType = document.querySelector('input[name="dateType"]:checked').value;
            let date = '';
            if (dateType === 'full') {
                date = document.getElementById('dateFull').value;
            } else {
                date = document.getElementById('dateMonth').value;
            }

            let baseUrl = '/blessings?name=' + encodeURIComponent(name) + '&wishing=' + encodeURIComponent(wishType);
            if (sender) {
                baseUrl += '&sender=' + encodeURIComponent(sender);
            }
            if (date) {
                baseUrl += '&date=' + encodeURIComponent(date);
            }

            // New Copy Message
            const fullLink = window.location.origin + baseUrl;
            let shareableText = `Click to see a special ${wishType} message for ${name}: ${fullLink}`;
            if (sender) {
                shareableText += `\n\n-${sender}`;
            }

            shareTextInput.value = shareableText;
            linkContainer.style.display = 'block';
        }

        function copyShareText() {
            shareTextInput.select();
            document.execCommand('copy');
            alert('Message copied, go ahead and send them the blessings!');
        }

        // Toggle date input fields
        document.getElementById('dateTypeFull').addEventListener('change', function() {
            document.getElementById('dateFullDiv').style.display = 'block';
            document.getElementById('dateMonthDiv').style.display = 'none';
        });
        document.getElementById('dateTypeMonth').addEventListener('change', function() {
            document.getElementById('dateFullDiv').style.display = 'none';
            document.getElementById('dateMonthDiv').style.display = 'block';
        });
    </script>
</body>

</html>