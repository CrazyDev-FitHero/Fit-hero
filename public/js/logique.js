const grid = document.querySelectorAll('.grid div');
const canvas = document.getElementById('patternCanvas');
const ctx = canvas.getContext('2d');
let isDrawing = false;
let pattern = [];
let startPosition = null;

let score=1;
let compteur =0;
let tableauDePattern=[];


// Clear the canvas
function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

// Handle starting the pattern
grid.forEach(dot => {
    dot.addEventListener('mousedown', (e) => {
        startPattern(dot);
    });

    dot.addEventListener('mouseover', (e) => {
        if (isDrawing) {
            continuePattern(dot);
        }
    });
});


function isInsideGrid(dot) {
    return dot.closest('.grid') !== null;
}
let initialClickInsideGrid = false;
function startPattern(dot) {
    if (!isInsideGrid(dot)) return;
    initialClickInsideGrid = true;
    clearCanvas();
    isDrawing = true;
    pattern = [];
    const index = dot.getAttribute('data-index');
    pattern.push(index);
    dot.classList.add('active');
    startPosition = getDotPosition(dot);

}

function continuePattern(dot) {
    if (!isInsideGrid(dot)) return;
    const index = dot.getAttribute('data-index');
    if (!pattern.includes(index)) {
        pattern.push(index);
        dot.classList.add('active');

        const endPosition = getDotPosition(dot);
        drawLine(startPosition, endPosition);
        startPosition = endPosition;
    }
}
const patternCounter = document.getElementById('patternCounter');

function endPattern() {
    if (!initialClickInsideGrid) return;
    isDrawing = false;
    if (pattern.length > 0) {
        compteur++;
        tableauDePattern.push(pattern);
        validatePattern();
    }
    setTimeout(() => {
        clearCanvas();
        grid.forEach(dot => dot.classList.remove('active'));
    }, 200);
    initialClickInsideGrid = false;
}

function getDotPosition(dot) {
    const rect = dot.getBoundingClientRect();
    return {
        x: rect.left + rect.width / 2 - canvas.getBoundingClientRect().left,
        y: rect.top + rect.height / 2 - canvas.getBoundingClientRect().top
    };
}
// test
function drawLine(start, end) {
    ctx.beginPath();
    ctx.moveTo(start.x, start.y);
    ctx.lineTo(end.x, end.y);
    ctx.strokeStyle = '#00000050';
    ctx.lineWidth = 20;
    ctx.stroke();
    ctx.closePath();
}

document.addEventListener('mouseup', endPattern);
document.addEventListener('contextmenu', function(event) {
    event.preventDefault();
});

function arraysEqual(arr1, arr2) {
    if (arr1.length !== arr2.length) return false;

    for (let i = 0; i < arr1.length; i++) {
        if (arr1[i] !== arr2[i]) break;
        if (i === arr1.length - 1) return true;
    }

    for (let i = 0; i < arr1.length; i++) {
        if (arr1[i] !== arr2[arr2.length - 1 - i]) return false;
    }

    return true;
}


function validatePattern() {
    if (compteur == 11) {
        location.reload();
        return;
    }

    const images = document.querySelectorAll('.flex-row img');
    const expectedPattern = JSON.parse(expectedSeries[compteur - 1]);

    if (arraysEqual(tableauDePattern[compteur - 1], expectedPattern)) {
        images[compteur - 1].classList.add('check-mark');
        images[compteur - 1].classList.remove('cross-mark');
        score++;

        displayGif(compteur - 1); // Affiche le GIF correspondant
        ajax('gagner');

    } else {
        images[compteur - 1].classList.add('cross-mark');
        images[compteur - 1].classList.remove('check-mark');

        ajax('perdre');
    }
}

function ajax(PerdreOuGagner) {
    fetch('/' + PerdreOuGagner + '-str', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            pattern: JSON.stringify(pattern)
        })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if(PerdreOuGagner === 'gagner')
                displayMessage("+");
            else
                displayMessage("-");


        })
        .catch(error => console.error('Erreur:', error));
}

function displayMessage(message) {
    const plusMoinsDiv = document.getElementById('plus-moins-id');
    plusMoinsDiv.textContent = message;
    if (message === "+") {
        plusMoinsDiv.style.borderColor = "green";
        plusMoinsDiv.style.backgroundColor = "#90EE90";
        plusMoinsDiv.style.color = '#556B2F';
    } else {
        plusMoinsDiv.style.borderColor = "red";
        plusMoinsDiv.style.backgroundColor = "#DC143C";
        plusMoinsDiv.style.color = '#970c0c';
    }

    setTimeout(() => {
        plusMoinsDiv.textContent = '';
        plusMoinsDiv.style.borderColor = "black";
        plusMoinsDiv.style.backgroundColor = "#3E4686";
    }, 2000);
}
function displayGif(index) {
    const imageContainer = document.querySelector('.image');
    imageContainer.innerHTML = `<img src="data:image/gif;base64,${gifExercices[index]}" alt="Exercice GIF${index + 1}">`;
}
