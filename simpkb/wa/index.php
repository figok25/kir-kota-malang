<!DOCTYPE html>
<html>

<body>

<input type="text" value="Hello World" id="myInput">
<button onclick="myFunction()">Copy text</button>

<script>
function myFunction() {

  navigator.clipboard.writeText("11111");

  alert("Copied the text: " + "11111");
}
</script>
</body>

</html>
