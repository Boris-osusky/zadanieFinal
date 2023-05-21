function renderMath() {
  var input = document.getElementById("answerTaskInput").value;
  var output = document.getElementById("mathOutput");
  output.innerHTML = "\\(" + input + "\\)";
  MathJax.typesetPromise([output]).catch(function (err) {
    output.innerHTML = "Chyba pri zobrazovaní matematického vzorca: " + err.message;
  });
}

function renderButtons(){
  var sqrtNormal = document.getElementById("sqrtNormal");
  //var output = document.getElementById("mathOutput");
  sqrtNormal.value = "\\(" + sqrtNormal.value + "\\)";
  MathJax.typesetPromise([sqrtNormal]).catch(function (err) {
    sqrtNormal.value = "Chyba pri zobrazovaní matematického vzorca: " + err.message;
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
        case 'sin': input.value = textBeforeCursor+ "\\sin"+ textAfterCursor;
        break;
        case 'cos': input.value = textBeforeCursor+ "\\cos"+ textAfterCursor;
        break;
        case 'tan': input.value = textBeforeCursor+ "\\tan"+ textAfterCursor;
        break;
        case 'frac': input.value = textBeforeCursor+ "\\frac{x}{y}"+ textAfterCursor;
        break;
        case 'square': input.value = textBeforeCursor+ "\[\]"+ textAfterCursor;
        break;
        case 'round': input.value = textBeforeCursor+ "\(\)"+ textAfterCursor;
        break;
        default: break;
    }
        renderMath();
}