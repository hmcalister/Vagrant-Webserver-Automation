flagged_array = [];
bomb_array = [];
for (let i = 0; i < height; i++) {
    flagged_array.push([])
    bomb_array.push([]);
    for (let j = 0; j < width; j++) {
        flagged_array[i].push(0);
        bomb_array[i].push(Math.random() < bomb_ratio);
    }
}

function gameover() {
    // alert("BOOM");
}

function get_coords(coord_str) {
    var coords = coord_str.split(",");
    return [parseInt(coords[0]), parseInt(coords[1])];
}

function btn_click(btn) {
    coords = get_coords(btn.value);
    if (flagged_array[coords[0]][coords[1]]) {
        return;
    }
    if (bomb_array[coords[0]][coords[1]]) {
        btn.innerHTML = "<img src='images/mine.png'>";
        gameover();
        return;
    }
    var neighbour_bomb_count = 0;
    for (let del_y = -1; del_y <= 1; del_y++) {
        for (let del_x = -1; del_x <= 1; del_x++) {
            let y = coords[0] + del_y;
            let x = coords[1] + del_x;
            if (x < 0 || x >= width || y < 0 || y >= width) {
                continue;
            }
            neighbour_bomb_count += bomb_array[y][x];
        }
    }
    btn.innerHTML = neighbour_bomb_count;
    btn.classList.add("noHover");
    btn.disabled = true;
}

function btn_flag(btn) {
    if (btn.disabled){return;}
    coords = get_coords(btn.value);
    if (flagged_array[coords[0]][coords[1]]) {
        flagged_array[coords[0]][coords[1]] = false;
        btn.innerHTML = "";
        btn.classList.add("noHover");
    } else {
        flagged_array[coords[0]][coords[1]] = true;
        btn.innerHTML = "<img src='images/flag.png'>";
        btn.classList.add("noHover");
    }
}

function game_setup() {
    var game_div = document.getElementById("game");
    for (let col = 0; col < width; col++) {
        let row_div = document.createElement("div");
        row_div.className = "game_row";
        game_div.appendChild(row_div);
        for (let row = 0; row < height; row++) {
            let btn = document.createElement("button");
            btn.value = col + "," + row;
            btn.addEventListener("click", function () {
                btn_click(btn);
            });
            btn.addEventListener("contextmenu", function () {
                btn_flag(btn);
            });
            row_div.appendChild(btn);
        }
        game_div.appendChild(document.createElement("br"));
    }
}
document.addEventListener("DOMContentLoaded", game_setup);