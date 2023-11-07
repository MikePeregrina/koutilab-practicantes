const actualizar = () => {
    const cd = document.getElementById("html-code");
    const cd1 = document.getElementById("css-code");
    const cd2 = document.getElementById("js-code");
    const editor = document.getElementById("output");
    editor.srcdoc = cd.value;
    if (cd.value == '') {
        document.getElementById("update").disabled = true;
    } else {
        document.getElementById("update").disabled = false;
    }
}
