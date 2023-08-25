function init() {
    document.querySelector("h1 > b").innerText = getUrlParam("name");

    getQuestion();
    document.getElementsByClassName("button")[0].addEventListener("click", next);
}

function getQuestion() {
    document.getElementById("question-number").innerText = `Question ${currentQuestion + 1}`;
    document.getElementById("question").innerText = questions[currentQuestion].question;
    document.getElementById("choice-A").innerText = questions[currentQuestion].choiceA;
    document.getElementById("choice-B").innerText = questions[currentQuestion].choiceB;
    document.getElementById("choice-C").innerText = questions[currentQuestion].choiceC;
}

function next(event) {
    if (getSelection("choices") === questions[currentQuestion].answer) {
        correctAnswers++;
    }

    currentQuestion++;
    if (currentQuestion < questions.length) {
        getQuestion();
        clearSelection("choices");
    } else {
        showResults();
    }
}

function showResults() {
    let results = "";
    let score = correctAnswers / questions.length * 100;

    if (score < 30) {
        results += "Bad luck. ";
    } else if (score >= 30 && score <=75) {
        results += "Not bad. ";
    } else {
        results += "Impressive! ";
    }

    document.getElementById("results").innerText = results + `You final score was ${score.toFixed(1)}% (${correctAnswers}/${questions.length}).`;
    document.getElementById("results").style.display = "unset";
    document.getElementById("quiz").style.display = "none";
    document.getElementsByClassName("button")[0].style.display = "none";

}

let currentQuestion = 0;
let correctAnswers = 0;

init();
