const actualizar =() =>{
    const cd = document.getElementById("cd");
    const editor = document.getElementById("editor");
    editor.srcdoc = cd.value;
    if (cd.value == '') {
        document.getElementById("update").disabled = true;
      } else {
        document.getElementById("update").disabled = false;
      }
}
