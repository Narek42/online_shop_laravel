
function search() {
    let inp = document.getElementById("search").value
    console.log(inp);
    let form = new FormData();
    form.append("name", inp)
    axios.post("/user/search", form)
        .then(r => {
        console.log(r);
    })
}
