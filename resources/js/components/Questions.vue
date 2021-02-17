<template>
    <div class="p-6">
        <h1 class="text-3xl mb-4">Questions</h1>

        <div class="w-full flex shadow rounded-lg mb-2">
            <input type="text"
                   placeholder="Question..."
                   class="py-2 px-4 w-full rounded-l-lg focus:outline-none"
                   v-model="newQuestion"/>
            <button class="w-32 py-2 text-white rounded-r-lg focus:outline-none"
                    :class="addingQuestion ? 'bg-gray-300' : 'bg-gray-800'"
                    @click="addQuestion">
                Add
            </button>
        </div>

        <transition-group tag="div" name="question-list">
            <div v-for="question in sortedQuestions" :key="question.id"
                 class="p-4 bg-white rounded-lg shadow mb-2 flex flex-col">
                <div class="flex">
                    <div class="w-full">
                        {{ question.text }}
                    </div>

                    <div class="w-12 cursor-pointer flex" @click="voteFor(question)">
                        <svg xmlns="http://www.w3.org/2000/svg" :fill="question.voted_by_me ? 'black' : 'none'"
                             viewBox="0 0 24 24" stroke="currentColor" class="w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>

                        <span class="text-center flex-grow">{{ question.votes }}</span>
                    </div>
                </div>

                <div class="text-gray-400 text-sm">
                    {{ question.created_at | fromNow }}
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    name: 'Photos',

    data() {
        return {
            questions: [],
            newQuestion: '',
            addingQuestion: false,
        };
    },

    filters: {
        fromNow(date) {
            return moment(date).fromNow();
        }
    },

    computed: {
        sortedQuestions() {
            return _.sortBy(this.questions, question => -question.votes);
        }
    },

    mounted() {
        this.loadQuestions();
        this.setupWebsockets();
    },

    methods: {
        async loadQuestions() {
            try {
                let {data: response} = await axios.get('/questions');

                this.questions = response.data;
            } catch (error) {
                console.error(error);
                alert('Unable to load questions!');
            }
        },

        async loadQuestion(question) {
            try {
                let {data: response} = await axios.get('/questions/' + question.id);

                let newQuestion = response.data;
                let index = _.findIndex(this.questions, {id: newQuestion.id});

                if (index === -1) {
                    this.questions.push(newQuestion);

                    return;
                }

                this.questions.splice(index, 1, newQuestion);
            } catch (error) {
                console.error(error);
                alert('Unable to load question!');
            }
        },

        async addQuestion() {
            if (this.addingQuestion) {
                return;
            }

            this.addingQuestion = true;

            try {
                let {data: response} = await axios.post('/questions', {text: this.newQuestion});

                this.questions.push(response.data);

                this.addingQuestion = false;
                this.newQuestion = '';
            } catch (error) {
                console.error(error);
                alert('Unable to add question!');
            }
        },

        async voteFor(question) {
            question.votes = question.votes + (question.voted_by_me ? -1 : 1);
            question.voted_by_me = !question.voted_by_me;

            try {
                await axios.post('/questions/' + question.id + '/vote', {positive_vote: question.voted_by_me});
            } catch (error) {
                console.error(error);
                alert('Unable to vote for question!');
            }
        },

        handleWSQuestion(event) {
            if (!event || !event.question) {
                return;
            }

            let question = JSON.parse(event.question);

            this.loadQuestion(question);
        },

        setupWebsockets() {
            Echo.channel('main-channel')
                .listen('QuestionCreated', this.handleWSQuestion)
                .listen('QuestionUpdated', this.handleWSQuestion);
        },
    },
};
</script>

<style>
.question-list-move {
    transition: transform 1s;
}
</style>
