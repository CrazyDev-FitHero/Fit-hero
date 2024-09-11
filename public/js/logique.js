
const grid = document.querySelectorAll('.grid div');
const canvas = document.getElementById('patternCanvas');
const ctx = canvas.getContext('2d');
let isDrawing = false;
let pattern = [];
const correctPattern = ["0", "1", "2", "4", "8"];
const correctPattern2 = ["0", "1", "2","5","4","3","6", "7", "8"];
let startPosition = null;

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

document.addEventListener('mouseup', endPattern);

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

function endPattern() {
    if (!initialClickInsideGrid) return;
    isDrawing = false;
    if (pattern.length > 0) {
        validatePattern();
    }
    setTimeout(() => {
        clearCanvas();
        grid.forEach(dot => dot.classList.remove('active'));
    }, 200);
    initialClickInsideGrid = false;
}
document.addEventListener('mouseup', endPattern);

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
    ctx.strokeStyle = '#4ABDAC';
    ctx.lineWidth = 5;
    ctx.stroke();
    ctx.closePath();
}

function validatePattern() {
    // if (JSON.stringify(pattern) === JSON.stringify(correctPattern) || JSON.stringify(pattern) === JSON.stringify(correctPattern2)) {
    //     alert('Pattern reconnu!');
    // } else {
    //     alert('Pattern inconnu!');
    // }
    alert(JSON.stringify(pattern));
}

document.addEventListener('contextmenu', function(event) {
    event.preventDefault();
});
