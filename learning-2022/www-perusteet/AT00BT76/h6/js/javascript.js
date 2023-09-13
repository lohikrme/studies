

function generateAnswer () {
    number = 0
    number = Math.ceil(Math.random() * 100)
    if (number > 0) {
        return number
    } {

    }
}

let answer = generateAnswer()
console.log(answer) /* tarkista mikä oikea vastaus on consolessa */
let playerGuess = 0
let guessesRemaining = 10
let guessesMade = 0
let gameState = ""
let gameWon = false

let output = document.querySelector("#output")
let input = document.querySelector("#input")
let button = document.querySelector("button")
button.style.cursor = "pointer"
button.addEventListener("click", clickHandler, false)
window.addEventListener("keydown", keydownHandler, false)

function keydownHandler (event) {
    console.log(event) /* tarkista mikä on enterin keyCode numero (on 13) */
    if (event.keyCode === 13) {
        validateInput();
    }
}

function clickHandler () {
    validateInput()
}

function validateInput () {
    playerGuess = parseInt(input.value)
    if (isNaN(playerGuess)) {
        output.innerHTML = "Vain numerot sallittuja."
    }
    else if (playerGuess < 1 || playerGuess > 100) {
            output.innerHTML = "Syötä luku väliltä 1-100."
        }
    else {
        arrowLocation()
        playGame()
        
    }
}

function arrowLocation () {
    /* here change the left-pixel of arrow and game will be final */

    pixels = 10+playerGuess*4+"px"
    document.getElementById("arrow").style.left = pixels;
}


function playGame () {
    guessesRemaining--
    guessesMade++

    gameState = "Arvauksia on jäljellä " + guessesRemaining + "." 

    console.log(answer - playerGuess) /* this should be 0 when answer right */

    if (playerGuess > answer) {
        output.innerHTML = "Arvauksesi on liian iso. " + gameState}
        if (guessesRemaining < 1) {
            endGame()
    }
    else if (playerGuess < answer) {
        output.innerHTML = "Arvauksesi on liian pieni." + gameState}
        if (guessesRemaining < 1) {
            endGame()
    }
    else if (playerGuess == answer) {
        gameWon = true
        endGame()
    }
}

function endGame () {
    if (gameWon) {
        output.innerHTML = "ARVASIT OIKEIN! JEE! Oikea vastaus oli " + answer + ". Tarvitsit " + guessesMade + " arvausta arvataksesi oikein!"
    }
    
    else {
        output.innerHTML = "Et ehtinyt arvata numeroa riittävän nopeasti. HÄVISIT PELIN! Oikea vastaus olisi ollut " + answer + "."
    }
    button.removeEventListener("click", clickHandler, false)
    window.removeEventListener("keydown", keydownHandler, false)
    button.disabled = true
    input.disabled = true

}

