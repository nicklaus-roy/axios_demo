<html>
    <head></head>
    <body>
        <div id = 'app'>
            Select Category:
            {{-- Listen to the onchange event and execute the fetchQuestions method --}}
            <select name="" id="" v-on:change='fetchQuestions' v-model='selected_category'>
                {{-- Loop through the categories and display each category --}}
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <p>Without Multiple Choice</p>
            <ul>
                {{-- loop through the filtered questions --}}
                <li v-for='question in withoutMultipleChoice'>
                    @{{ question.body }}
                </li>
            </ul>
            <p>With Multiple Choice</p>
            <ul>
                {{-- loop through the filtered questions --}}
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
                            //assign the data to the questions array in the data attribute of vm
                            vm.questions = response.data;
                        });
                }
            },
            computed: {
                withMultipleChoice() {
                    //return filtered questions
                    return this.questions.filter(function(question) {
                        //return only the questions wherein the is_multiple_choice is equal to 1
                        return question.is_multiple_choice == 1;
                    });
                },
                withoutMultipleChoice() {
                    //return filtered questions
                    return this.questions.filter(function(question) {
                        //return only the questions wherein the is_multiple_choice is equal to 0
                        return question.is_multiple_choice == 0;
                    });
                }
            }
        })
    </script>
</html>