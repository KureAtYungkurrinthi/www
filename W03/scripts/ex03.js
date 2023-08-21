let guess = "";
let answer = "a keyboard";

const hint = document.querySelector("#hint");
const hintBtn = document.querySelector("#getHint");
const soln = document.querySelector("#solution");
const guessFld = document.querySelector("#guess");

hintBtn.addEventListener("click", () => {
    hint.classList.remove("hidden");
    hintBtn.classList.add("hidden");
});

guessFld.addEventListener("change", () => {
    guess = document.querySelector("#guess").value;
    guess = guess.toLowerCase();
    checkGuess();
});

function checkGuess(){
    const msg =document.createElement("p");
    if(guess === answer){
        msg.innerText = 'Congratulations, that is correct!';
        
    }else{
        msg.innerText = "Unfortunately, that guess was wrong.";
    }
    soln.prepend(msg);
    soln.classList.remove("hidden");
}