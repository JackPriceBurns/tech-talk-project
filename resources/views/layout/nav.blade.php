<div class="w-full shadow flex justify-center bg-white">
    <div class="container flex justify-between">
        <a href="{{ route('home') }}" class="p-6 bg-gray-800">
            <span class="font-mono font-bold text-white">Tech Talk</span>
        </a>

        <div class="flex">
            <a href="{{ route('qa.index') }}" class="p-6 hover:font-bold">
                <span>Q&A</span>
            </a>

            <a href="{{ route('photos.create') }}" class="p-6 hover:font-bold">
                <span>Upload</span>
            </a>
        </div>
    </div>
</div>
