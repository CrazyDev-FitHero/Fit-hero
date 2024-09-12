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

function updatePatternCounter() {
    patternCounter.textContent = `Patterns: ${tableauDePattern.length}`;
}
function endPattern() {
    if (!initialClickInsideGrid) return;
    isDrawing = false;
    if (pattern.length > 0) {
        compteur++;
        tableauDePattern.push(pattern);
        updatePatternCounter(); // Update the counter
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
        if (arr1[i] !== arr2[i]) return false;
    }
    return true;
}

function validatePattern()
{
    const images = document.querySelectorAll('.flex-row img');
    const expectedPattern = JSON.parse(expectedSeries[compteur-1]);
    // console.log(tableauDePattern[compteur-1], expectedPattern);
    // console.log(compteur-1);
    console.log(score);


    if (arraysEqual(tableauDePattern[compteur-1], expectedPattern)) {
        images[compteur-1].classList.add('check-mark');
        images[compteur-1].classList.remove('cross-mark');
        score++;
    }
    else {
        images[compteur-1].classList.add('cross-mark');
        images[compteur-1].classList.remove('check-mark');
    }
}


document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('failedAttempt') === 'true') {
        const message = document.createElement('div');
        message.textContent = 'Vous avez échoué';
        message.style.position = 'fixed';
        message.style.top = '10%';
        message.style.left = '50%';
        message.style.transform = 'translate(-50%, -50%)';
        message.style.backgroundColor = 'red';
        message.style.color = 'white';
        message.style.padding = '1rem';
        message.style.borderRadius = '8px';
        document.body.appendChild(message);

        setTimeout(() => {
            message.remove();
            localStorage.removeItem('failedAttempt');
        }, 3000);
    }
});
// function validatePattern() {
//     if (!pattern || pattern.length === 0) {
//         console.error('Pattern is empty or undefined');
//         return;
//     }
//     //alert(JSON.stringify(pattern))
//     fetch('/validate-pattern', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             pattern: pattern
//         })
//     })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             if (data.success) {
//                 alert(data.message); // Pattern reconnu
//             } else {
//                 alert(data.message); // Pattern inconnu
//             }
//         })
//         .catch(error => console.error('Erreur:', error));
// }

// function validatePattern() {
//     if (compteur == 10) {
//         const images = document.querySelectorAll('.flex-row img');
//         for (let i = 0; i < 10; i++) {
//             const expectedPattern = JSON.parse(expectedSeries[i]);
//             console.log(tableauDePattern[i], expectedPattern);
//             if (arraysEqual(tableauDePattern[i], expectedPattern)) {
//                 images[i].classList.add('check-mark');
//                 images[i].classList.remove('cross-mark');
//                 score++;
//             } else {
//                 images[i].classList.add('cross-mark');
//                 images[i].classList.remove('check-mark');
//             }
//         }
//         console.log(score);
//
//         if (score < 5) {
//             localStorage.setItem('failedAttempt', 'true');
//             location.reload();
//         }
//     }
// }

