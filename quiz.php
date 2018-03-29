<html>
<head>
    <script src="js/jquery-1.11.1.min.js"></script>
    <style>
        @import url(http://fonts.googleapis.com/css?family=Rokkitt);
        h1 {
            font-family: 'Rokkitt', serif;
            text-align: center;
        }

        ul {
            list-style: none;
        }

        li {
            font-family: 'Rokkitt', serif;
            font-size: 2em;
        }

        input[type=radio] {
            border: 0px;
            width: 20px;
            height: 2em;
        }

        p {
            font-family: 'Rokkitt', serif;
        }

        /* Quiz Classes */

        .quizContainer {
            background-color: lightgoldenrodyellow;
            border-radius: 6px;
            width: 75%;
            margin: auto;
            padding-top: 5px;
            -moz-box-shadow: 10px 10px 5px #888;
            -webkit-box-shadow: 10px 10px 5px #888;
            box-shadow: 10px 10px 5px #888;
            position: relative;
        }

        .nextButton {
            box-shadow: 3px 3px 5px #888;
            border-radius: 6px;
            width: 150px;
            height: 40px;
            text-align: center;
            background-color: lightgrey;
            /*clear: both;*/
            color: red;
            font-family: 'Rokkitt', serif;
            position: relative;
            margin: auto;
            padding-top: 20px;
        }

        .question {
            font-family: 'Rokkitt', serif;
            font-size: 2em;
            width: 90%;
            height: auto;
            margin: auto;
            border-radius: 6px;
            background-color: lightgrey;
            text-align: center;
        }

        .quizMessage {
            background-color: peachpuff;
            border-radius: 6px;
            width: 30%;
            margin: auto;
            text-align: center;
            padding: 2px;
            font-family: 'Rokkitt', serif;
            color: red;
        }

        .choiceList {
            font-family: Courier, serif;
            color: blueviolet;
        }

        .result {
            width: 30%;
            height: auto;
            border-radius: 6px;
            background-color: linen;
            margin: auto;
            text-align: center;
            font-family: 'Rokkitt', serif;
        }

        /* End of Quiz Classes */

    </style>
    <script>
        /**
         * Created with JetBrains WebStorm.
         * User: pwanwu
         * Date: 18/09/2013
         * Time: 17:41
         * To change this template use File | Settings | File Templates.
         */

        var questions = [{
            question: "What is the population of Brazil?",
            choices: ["145 million", "199 million", "182 million", "205 million"],
            correctAnswer: 1
        }, {
            question: "What is 27*14?",
            choices: ["485", "634", "408", "528"],
            correctAnswer: 2
        }, {
            question: "What is the busiest train station in the world?",
            choices: ["Grand Central, NY", "Shibuya, Tokyo", "Beijing Central, Chine", "Gard du Nord, Paris"],
            correctAnswer: 1
        }, {
            question: "What is the longest river?",
            choices: ["Nile", "Amazon", "Mississippi", "Yangtze"],
            correctAnswer: 0
        }, {
            question: "What is the busiest tube station in the London?",
            choices: ["Waterloo", "Baker Street", "Kings Cross", "Victoria"],
            correctAnswer: 0
        }];

        var currentQuestion = 0;
        var correctAnswers = 0;
        var quizOver = false;

        $(document).ready(function() {

            // Display the first question
            displayCurrentQuestion();
            $(this).find(".quizMessage").hide();

            // On clicking next, display the next question
            $(this).find(".nextButton").on("click", function() {
                if (!quizOver) {

                    value = $("input[type='radio']:checked").val();

                    if (value == undefined) {
                        $(document).find(".quizMessage").text("Please select an answer");
                        $(document).find(".quizMessage").show();
                    } else {
                        // TODO: Remove any message -> not sure if this is efficient to call this each time....
                        $(document).find(".quizMessage").hide();

                        if (value == questions[currentQuestion].correctAnswer) {
                            correctAnswers++;
                        }

                        currentQuestion++; // Since we have already displayed the first question on DOM ready
                        if (currentQuestion < questions.length) {
                            displayCurrentQuestion();
                        } else {
                            displayScore();
                            //                    $(document).find(".nextButton").toggle();
                            //                    $(document).find(".playAgainButton").toggle();
                            // Change the text in the next button to ask if user wants to play again
                            $(document).find(".nextButton").text("Play Again?");
                            quizOver = true;
                        }
                    }
                } else { // quiz is over and clicked the next button (which now displays 'Play Again?'
                    quizOver = false;
                    $(document).find(".nextButton").text("Next Question");
                    resetQuiz();
                    displayCurrentQuestion();
                    hideScore();
                }
            });

        });

        // This displays the current question AND the choices
        function displayCurrentQuestion() {

            console.log("In display current Question");

            var question = questions[currentQuestion].question;
            var questionClass = $(document).find(".quizContainer > .question");
            var choiceList = $(document).find(".quizContainer > .choiceList");
            var numChoices = questions[currentQuestion].choices.length;

            // Set the questionClass text to the current question
            $(questionClass).text(question);

            // Remove all current <li> elements (if any)
            $(choiceList).find("li").remove();

            var choice;
            for (i = 0; i < numChoices; i++) {
                choice = questions[currentQuestion].choices[i];
                $('<li><input type="radio" value=' + i + ' name="dynradio" />' + choice + '</li>').appendTo(choiceList);
            }
        }

        function resetQuiz() {
            currentQuestion = 0;
            correctAnswers = 0;
            hideScore();
        }
    </script>

</head>
<body>
<div class="quizContainer">
    <h1>Hello! Welcome to the JS Dynamic Quiz!</h1>

    <div class="question"></div>
    <ul class="choiceList"></ul>
    <div class="quizMessage"></div>
    <div class="result"></div>
    <div class="nextButton">Next Question</div>
    <br>
</div>
</body>
</html>