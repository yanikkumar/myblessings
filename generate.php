<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate My Happy Blessings | Greatsite</title>
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
                <div class="flex items-center mb-2">
                    <input type="radio" id="birthday" name="wishType" value="birthday"
                        class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                    <label for="birthday" class="text-gray-700 text-sm font-medium">Birthday</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="anniversary" name="wishType" value="anniversary"
                        class="mr-2 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="anniversary" class="text-gray-700 text-sm font-medium">Anniversary</label>
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
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date of Anniversary (YYYY-MM-DD,
                    Optional):</label>
                <input type="date" id="date" name="date"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="button" onclick="validateAndGenerate()"
                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Generate
                Link</button>
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
            const date = document.getElementById('date').value;
            const wishType = document.querySelector('input[name="wishType"]:checked').value;

            let baseUrl = '/blessings?name=' + encodeURIComponent(name) + '&wishing=' + encodeURIComponent(wishType);
            if (sender) {
                baseUrl += '&sender=' + encodeURIComponent(sender);
            }
            if (date) {
                baseUrl += '&date=' + encodeURIComponent(date);
            }

            // New Copy Message
            const fullLink = window.location.origin + baseUrl;
            const shareableText = `Click to see a special ${wishType} message for ${name}: ${fullLink}`;

            shareTextInput.value = shareableText;
            linkContainer.style.display = 'block';
        }

        function copyShareText() {
            shareTextInput.select();
            document.execCommand('copy');
            alert('Message copied, go ahead and send them the blessings!');
        }
    </script>
</body>

</html>