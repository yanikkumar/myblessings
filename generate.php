<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Birthday Link</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-purple-400 to-pink-500 bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-4 text-center text-indigo-600">Generate Birthday Link</h2>
        <form id="birthdayForm">
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
                <label for="dob" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth (YYYY-MM-DD,
                    Optional):</label>
                <input type="date" id="dob" name="dob"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="button" onclick="validateAndGenerate()"
                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Generate
                Link</button>
        </form>
        <div id="linkContainer" class="mt-6 text-center">
            <p class="text-gray-700 font-semibold">Send this link:</p>
            <div class="mt-2 border rounded p-2 bg-gray-100">
                <input type="text" id="birthdayLink" value=""
                    class="w-full text-sm text-gray-600 bg-transparent border-none focus:outline-none" readonly>
            </div>
            <button onclick="copyLink()"
                class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Copy
                Link</button>
        </div>
    </div>

    <script>
        const nameInput = document.getElementById('name');
        const nameError = document.getElementById('nameError');

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

        const linkContainer = document.getElementById('linkContainer');
        const birthdayLinkInput = document.getElementById('birthdayLink');

        linkContainer.style.display = 'none'; // Hide initially

        function generateLink() {
            const name = document.getElementById('name').value;
            const sender = document.getElementById('sender').value;
            const dob = document.getElementById('dob').value;

            let baseUrl = '/birthday-wish?name=' + encodeURIComponent(name);
            if (sender) {
                baseUrl += '&sender=' + encodeURIComponent(sender);
            }
            if (dob) {
                baseUrl += '&dob=' + encodeURIComponent(dob);
            }

            birthdayLinkInput.value = window.location.origin + baseUrl;
            linkContainer.style.display = 'block';
        }

        function copyLink() {
            birthdayLinkInput.select();
            document.execCommand('copy');
            alert('Link copied, go ahead and send them the blessings!');
        }
    </script>
</body>

</html>