<html>
    <head></head>
    <body>
        <div id = 'app'>
            Select Category:
            <select name="" id="" v-on:change='fetchQuestions' v-model='selected_category'>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <p>Without Multiple Choice</p>
            <ul>
                <li v-for='question in withoutMultipleChoice'>
                    @{{ question.body }}
                </li>
            </ul>
            <p>With Multiple Choice</p>
            <ul>
                <li v-for='question in withMultipleChoice'>
                    @{{ question.body }}
                </li>
            </ul>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="/js/axios.min.js"></script>
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                selected_category: '',
                questions: []
            },
            methods: {
                fetchQuestions() {
                    //use axios to get questions based on their category
                    axios.get('/questions?category_id='+this.selected_category)
                        .then(function(response) {
                            console.log(response.data);
                            vm.questions = response.data;
                        });
                }
            },
            computed: {
                withMultipleChoice() {
                    return this.questions.filter(function(question) {
                        return question.is_multiple_choice == 1;
                    });
                },
                withoutMultipleChoice() {
                    return this.questions.filter(function(question) {
                        return question.is_multiple_choice == 0;
                    });
                }
            }
        })
    </script>
</html>