<template>
    <div class="bg-white rounded-none sm:rounded shadow-lg mt-8" v-cloak @drop.prevent="addFile"
         @dragover.prevent>
        <div class="p-4 font-bold bg-gray-800 rounded-none sm:rounded-t text-white">
            Upload Photo
        </div>

        <div class="p-4">
            <div class="border-2 border-dashed p-8 text-center border-gray-300">
                <div class="flex justify-center">
                    <div class="w-48 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>

                <p><span class="font-bold">Drag and drop</span> to upload a file or click to upload manually</p>
            </div>

            <ul>
                <li v-for="file in files" class="bg-gray-100 p-2 mt-1 rounded">
                    {{ file.name }} ({{ file.size | kb }} kb)
                    <button @click="removeFile(file)" title="Remove">X</button>
                </li>
            </ul>

            <button :disabled="uploadDisabled"
                    @click="upload"
                    class="w-full p-2 mt-2 text-white rounded"
                    :class="uploadDisabled ? 'bg-blue-300 cursor-not-allowed' : 'bg-blue-600'">
                Upload
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PhotoUpload',

    filters: {
        kb: function (value) {
            return Math.floor(value / 1024);
        },
    },

    data() {
        return {
            files: [],
        };
    },

    computed: {
        uploadDisabled() {
            return this.files.length === 0;
        },
    },

    methods: {
        addFile(event) {
            let droppedFiles = event.dataTransfer.files;

            // If there is no file.
            if (!droppedFiles) {
                return;
            }

            // Only one file please.
            if (this.files.length >= 1) {
                alert('Please only upload one file.');

                return;
            }

            // Only drag one file at a time please.
            if (droppedFiles.length > 1) {
                alert('Please only drag one file at a time.');

                return;
            }

            // Add dropped files.
            _.each([...droppedFiles], file => {
                this.files.push(file);
            });
        },

        upload() {

        },

        removeFile(file) {
            this.files = this.files.filter(f => {
                return f !== file;
            });
        },
    },
};
</script>
