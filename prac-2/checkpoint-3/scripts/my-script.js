function init()
{
    const player = document.getElementById("player-name");
    player.innerText = getUrlParam("name"); 

    getQuestion();
}

function getQuestion() {
    const question = document.getElementById("question");
    const choiceA = document.getElementById("choice-A");
    const choiceB = document.getElementById("choice-B");
    const choiceC = document.getElementById("choice-C");

    question.innerText = questions[0].question;
    choiceA.innerText = questions[0].choiceA;
    choiceB.innerText = questions[0].choiceB;
    choiceC.innerText = questions[0].choiceC;
}

init();
