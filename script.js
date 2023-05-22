function renderMath() {
  var input = document.getElementById("answerTaskInput").value;
  var output = document.getElementById("mathOutput");
  output.innerHTML = "\\(" + input + "\\)";
  MathJax.typesetPromise([output]).catch(function (err) {
    output.innerHTML = "Chyba pri zobrazovaní matematického vzorca: " + err.message;
  });
}

function addOperation(op){
    var input = document.getElementById("answerTaskInput");
    var cursorPos= input.selectionStart;
    var textBeforeCursor = input.value.substring(0, cursorPos);
    var textAfterCursor = input.value.substring(cursorPos, input.value.length);
    switch(op){
      // OBRAZKY DO BUTTONS
        case 'sqrtN': input.value = textBeforeCursor+ "\\sqrt{x}" + textAfterCursor;
        break;
        case 'sqrtH': input.value = textBeforeCursor+ "\\sqrt[y]{x}"+ textAfterCursor;
        break;
        case 'expH': input.value = textBeforeCursor+ "x^y"+ textAfterCursor;
        break;
        case 'expL': input.value = textBeforeCursor+ "x_y"+ textAfterCursor;
        break;
        case 'sum': input.value = textBeforeCursor+ "\\sum_{i=1}^n y"+ textAfterCursor;
        break;
        case 'sin': input.value = textBeforeCursor+ "\\sin{x}"+ textAfterCursor;
        break;
        case 'cos': input.value = textBeforeCursor+ "\\cos{x}"+ textAfterCursor;
        break;
        case 'tan': input.value = textBeforeCursor+ "\\tan{x}"+ textAfterCursor;
        break;
        case 'frac': input.value = textBeforeCursor+ "\\frac{x}{y}"+ textAfterCursor;
        break;
        case 'lim': input.value = textBeforeCursor+ "\\lim_{n\\to\\infty}{x}"+ textAfterCursor;
        break;
        case 'integral': input.value = textBeforeCursor+ "\\int_y^n{x}"+ textAfterCursor;
        break;
        default: break;
    }
        renderMath();
}