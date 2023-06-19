let editor = document.querySelector("#editor");

ace.edit(editor, {
  theme: "ace/theme/xcode",
  mode: "ace/mode/javascript",
});

editor.setOptions({
  autoScrollEditorIntoView: true,
  copyWithEmptySelection: true,
});