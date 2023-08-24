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
    currentQuestion++;
    if (currentQuestion < questions.length) {
        getQuestion();
        clearSelection("choices");
    } else {
        document.getElementsByClassName("button")[0].style.display = "none";
    }
}

let currentQuestion = 0;

init();
