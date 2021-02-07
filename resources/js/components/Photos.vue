<template>
    <div class="p-6">
        <h1 class="text-3xl mb-4">Uploaded Photos</h1>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div v-for="photo in photos">
                <img :src="photo.url" class="w-full h-72 object-cover rounded-lg"/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Photos',

    data() {
        return {
            photos: [],
        };
    },

    mounted() {
        this.loadPhotos();
        this.setupWebsockets();
    },

    methods: {
        async loadPhotos() {
            try {
                let {data: response} = await axios.get('/photos');

                this.photos = response.data;
            } catch (error) {
                console.error(error);
                alert('Unable to load photos!');
            }
        },

        handlePhotoUploaded(event) {
            if (!event || !event.photo) {
                return;
            }

            let photo = JSON.parse(event.photo);

            this.photos.unshift(photo);
        },

        setupWebsockets() {
            Echo.channel('main-channel').listen('PhotoUploaded', this.handlePhotoUploaded);
        },
    },
};
</script>
