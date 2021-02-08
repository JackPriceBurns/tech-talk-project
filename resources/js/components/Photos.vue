<template>
    <div class="p-6">
        <h1 class="text-3xl mb-4">Uploaded Photos</h1>

        <div class="grid grid-cols-3 gap-4">
            <div v-for="partition in partitionedPhotos">
                <img :src="photo.url" class="w-full mt-4 object-cover rounded-lg" v-for="photo in partition"/>
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

    computed: {
        partitionedPhotos() {
            let index = 0;

            return _.groupBy(
                this.photos,
                () => {
                    if (index === 3) {
                        index = 0;
                    }

                    index++;

                    return (index - 1) % 3;
                }
            );
        },
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
