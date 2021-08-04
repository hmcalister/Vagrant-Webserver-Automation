// TODO: Change all references of document.getElementbyID(...) to get a table cell, and instead have an array to do this for us

// Define some global variables
flagged_array = [];     //An array to track the flags
bomb_array = [];        //An array to track where the bombs are. TODO: can we make this obfuscated?

// Some images that are used for GUI purposes
let mine_image = "<img src='images/mine.png'>";
let flag_image = "<img src='images/flag.png'>";
let empty_image = "<img src='images/empty.png'>";
let number_image = [];
for (let i = 0; i <= 8; i++) {
    number_image.push("<img src='images/" + i + ".png'>");
}

// When user clicks a bomb
function gameover() {
    // For each row
    for (let i = 0; i < height; i++) {
        // And each column
        for (let j = 0; j < width; j++) {
            // Get the cell
            let cell = document.getElementById(i + "," + j);
            // If it is a bomb, show it
            // So user knows where bombs are
            if (bomb_array[i][j]) {
                cell.innerHTML = mine_image;
            }
            // disable all cells, make them red and non-interactable
            cell.disabled = true;
            cell.classList.add("red_tint");
            cell.classList.add("no_interact");
        }
    }
    // Submit the score by AJAX
    submit_score(username, Date.now() - start, gamemode, 0);
    // Tell player they have lost
    document.getElementById("game_info").innerHTML = "You lose!";
}

// Check to see if player has won after a flag
function check_gamewon() {
    // For each row
    for (let i = 0; i < height; i++) {
        // And each column
        for (let j = 0; j < width; j++) {
            // If the bomb and flag matrices don't agree, game is not yet solved
            if (bomb_array[i][j] != flagged_array[i][j]) {
                console.log(i+","+j);
                return;
            }
        }
    }
    //Game is won!!
    // Submit the score by AJAX
    submit_score(username, Date.now() - start, gamemode, 1);

    // Update all cells to turn them green and disabled
    for (let i = 0; i < height; i++) {
        for (let j = 0; j < width; j++) {
            let cell = document.getElementById(i + "," + j);
            cell.disabled = true;
            cell.classList.add("green_tint");
            cell.classList.add("no_interact");
        }
    }
    // Inform the user they have won
    document.getElementById("game_info").innerHTML = "You win!";
}

// Get the coordinates of a cell based on id value
function get_coords(coord_str) {
    var coords = coord_str.split(",");
    return [parseInt(coords[0]), parseInt(coords[1])];
}

// When the user clicks a cell
function cell_click(cell) {
    // If cell is disabled (Already clicked, or a flag) do nothing
    if (cell.disabled) { return; }
    coords = get_coords(cell.id);
    let y = coords[0];
    let x = coords[1];

    // Check again if cell is flagged
    if (flagged_array[coords[0]][coords[1]]) {
        return;
    }

    // If cell is a bomb, game is over
    if (bomb_array[coords[0]][coords[1]]) {
        cell.innerHTML = mine_image
        gameover();
        return;
    }

    // See how many neighbours the cell has, to display the number
    var neighbour_bomb_count = 0;
    for (let del_y = -1; del_y <= 1; del_y++) {
        for (let del_x = -1; del_x <= 1; del_x++) {
            if (x + del_x < 0 || x + del_x >= width || y + del_y < 0 || y + del_y >= height) {
                continue;
            }
            neighbour_bomb_count += bomb_array[y + del_y][x + del_x];
        }
    }

    // Update cell and ensure user cannot click again
    cell.innerHTML = number_image[neighbour_bomb_count];
    cell.classList.add("no_interact");
    cell.disabled = true;

    // If cell has NO bombs, click all neighbouring cells
    if (neighbour_bomb_count === 0) {
        for (let del_y = -1; del_y <= 1; del_y++) {
            for (let del_x = -1; del_x <= 1; del_x++) {
                if (x + del_x < 0 || x + del_x >= width || y + del_y < 0 || y + del_y >= height) {
                    continue;
                }
                cell_click(document.getElementById((y + del_y) + "," + (x + del_x)));
            }
        }
    }
    return;
}

//When the user flags a cell
function cell_flag(cell) {
    // If cell is disabled, don't allow flagging
    if (cell.disabled) { return; }

    // Find the cells coordinates
    coords = get_coords(cell.id);
    // If cell IS flagged, remove flag and replace by empty
    if (flagged_array[coords[0]][coords[1]]) {
        flagged_array[coords[0]][coords[1]] = false;
        cell.innerHTML = empty_image;
        cell.classList.remove("no_interact");
    } else {
        // Otherwise, make the cell a flag
        flagged_array[coords[0]][coords[1]] = true;
        cell.innerHTML = flag_image;
        cell.classList.add("no_interact");
    }
    // Check if user has flagged all bombs
    check_gamewon();
}

// Set up the game at load and restart
function game_setup() {
    // Reset global variables of the arrays    
    flagged_array=[];
    bomb_array=[];
    for (let i = 0; i < height; i++) {
        // Make the arrays into matrices
        flagged_array.push([])
        bomb_array.push([]);
        for (let j = 0; j < width; j++) {
            // All cells start unflagged
            flagged_array[i].push(0);
            // Determine if cell will be bomb by chance
            bomb_array[i].push(Math.random() < bomb_ratio);
        }
    }

    // Reset game info text, if user has clicked restart from a gameover/gamewon state
    document.getElementById("game_info").innerHTML = "";

    // Find the game div, and clear it (like above)
    var game_div = document.getElementById("game");
    game_div.innerHTML = "";

    // Add a table to the game div
    var game_table = document.createElement("table");
    game_div.appendChild(game_table);

    // Create a row for each row specified by game mode
    for (let row_num = 0; row_num < height; row_num++) {
        let row = document.createElement("tr");
        // Create a cell for each column specified by game mode
        for (let col_num = 0; col_num < width; col_num++) {
            let cell = document.createElement("td");
            // Give the cell an ID based on coordinate in the table
            cell.id = row_num + "," + col_num;
            // Set a click listener for cell_click()
            cell.addEventListener("click", function () {
                cell_click(cell);
            });
            // And a right click listener to flag the cell;
            cell.addEventListener("contextmenu", function () {
                cell_flag(cell);
            });
            // Make the cell empty and add it to the row
            cell.innerHTML = empty_image;
            row.appendChild(cell);
        }
        // Add the row to the table
        game_table.appendChild(row);
    }
    // The game is ready, start the timer!
    start = Date.now();
}
// When the page loads, set up the game
document.addEventListener("DOMContentLoaded", game_setup);

// Asynch insert the users score into the database
// username is a string, score is the milliseconds time spent solving the board, gamemode is the integer gamemode, and gamewon is 1 for true, 0 for false
function submit_score(username, score, gamemode, gamewon) {
    $.ajax({
        url: 'submit.php',
        type: 'POST',
        data: {
            username: username,
            score: score,
            gamemode: gamemode,
            gamewon: gamewon
        },
        success: function () {
            // A sanity check
            console.log(username, score, gamemode, gamewon);
        }
    })
}