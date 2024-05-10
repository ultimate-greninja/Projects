// window. innerWidth and window. innerHeight

let points = 0
let stop_points = 1
let pokemon_current_value = 0
let pokemon_opponent_value = 0
let lose = false
let point = false
let loop = 0
let pokemonNum = 0
let pokemonNum2 = 0
let shiny_odds = 4096
let shiny_chance = 0
let shiny_check = -1
let shiny_charm = 50
let unit = ""
const next = document.getElementById("next");
next.addEventListener("click",() => {
    // console.log("")
    // if (loop != 0){
    //     show_values(pokemon_current_value,pokemon_opponent_value,pokemonNum,pokemonNum2)
    //}
    if (point == true){
        points++
        if (shiny_chance == shiny_check){
            points++
        }
    }
    if (points >= 100){//4096 2048 1024 512 256 128 64
        shiny_charm = 100
        if (points >= 250){
            shiny_charm = 250
            if (points >= 500){
                shiny_charm = 500
                if (points >= 1000){
                    shiny_charm = 1000
                    if (points >= 2500){
                        shiny_charm = 2500
                        if (points >= 5000){
                            shiny_charm =5000 
                        }
                    }
                }

            }
        }

    }
    stop_points = points + 1
    shiny_chance = Math.floor(Math.random()*shiny_odds)
    shiny_check = Math.floor(Math.random()*shiny_odds)
    if (points >= shiny_charm){
        shiny_odds = shiny_odds/2
    }
    let subject = Math.floor(Math.random()*8);
    const subject_html = document.querySelector("#subject")
    const next_button = document.querySelector("#next")
    const pokemon_vs = document.querySelector("#pokemon_vs")
    const score = document.querySelector("#score")
    const box = document.querySelector("#box")
    box.innerHTML = `<input type="button" id = "ButtonH" value="Higher" onclick="Hchoice()">
    <input type="button" id = "ButtonL" value="Lower" onclick="Lchoice()">`
    next_button.innerHTML = `<input/>`
    next_button.innerHTML = `<input type="button" id = "next_css" value="Next" hidden />`
    pokemon_vs.innerHTML = `<div id = "pokemon_current">
        </div>
        <img id= "vs" src = "img/vsHoL.png">
        <div id = "pokemon_opponent">
        </div>`
    score.innerHTML = `<p>Score:${points}</p>`
    if (subject==0) {
        subject_html.textContent = "Height"
    }
    else if (subject== 1) {
        subject_html.textContent = "Weight"
    }
    else if (subject== 2) {
        subject_html.textContent = "Pokedex Number"
    }
    else if (subject== 3) {
        subject_html.textContent = "Hp"
    }
    else if (subject== 4) {
        subject_html.textContent = "Attack"
    }
    else if (subject== 5) {
        subject_html.textContent = "Defence"
    }
    else if (subject== 6) {
        subject_html.textContent = "Special Attack"
    }
    else if (subject== 7) {
        subject_html.textContent = "Speed"
    }
    pokemonNum = pokemonNum2
    if(loop == 0){
        let pokemonNum = (Math.floor(Math.random()*1010)+1).toString()
        let url = `https://pokeapi.co/api/v2/pokemon/${pokemonNum}`;
        fetch(url)
        .then(res =>res.json())
        .then(res =>{
            const pokemon_current = document.querySelector("#pokemon_current")
            if (shiny_chance == shiny_check && res.sprites.front_shiny != null){
                pokemon_current.innerHTML = `<p>${res.name}</p>
                <img src="${res.sprites.front_shiny}">`
            }
            else{
                pokemon_current.innerHTML = `<p>${res.name}</p>
                <img src="${res.sprites.front_default}">`
            }
            if (subject==0) {
                pokemon_current_value = res.height
            }
            else if (subject== 1) {
                pokemon_current_value = res.weight
            }
            else if (subject== 2) {
                pokemon_current_value = res.id
            }
            else if (subject== 3) {
                pokemon_current_value = res.stats[0].base_stat
            }
            else if (subject== 4) {
                pokemon_current_value = res.stats[1].base_stat
            }
            else if (subject== 5) {
                pokemon_current_value = res.stats[2].base_stat
            }
            else if (subject== 6) {
                pokemon_current_value = res.stats[3].base_stat
            }
            else if (subject== 7) {
                pokemon_current_value = res.stats[4].base_stat
            }
            // console.log(pokemon_current_value)
    })
    }
    else if (loop != 0){
        let pokemonNum = pokemonNum2
        let url = `https://pokeapi.co/api/v2/pokemon/${pokemonNum}`;
        fetch(url)
        .then(res =>res.json())
        .then(res =>{

            const pokemon_current = document.querySelector("#pokemon_current")
            if (shiny_chance == shiny_check && res.sprites.front_shiny != null){
                pokemon_current.innerHTML = `<p>${res.name}</p>
            <img src="${res.sprites.front_shiny}">`
            }
            else{
                pokemon_current.innerHTML = `<p>${res.name}</p>
            <img src="${res.sprites.front_default}">`
            }
            if (subject==0) {
                pokemon_current_value = res.height
            }
            else if (subject== 1) {
                pokemon_current_value = res.weight
            }
            else if (subject== 2) {
                pokemon_current_value = res.id
            }
            else if (subject== 3) {
                pokemon_current_value = res.stats[0].base_stat
            }
            else if (subject== 4) {
                pokemon_current_value = res.stats[1].base_stat
            }
            else if (subject== 5) {
                pokemon_current_value = res.stats[2].base_stat
            }
            else if (subject== 6) {
                pokemon_current_value = res.stats[3].base_stat
            }
            else if (subject== 7) {
                pokemon_current_value = res.stats[4].base_stat
            }
            // console.log(pokemon_current_value)
        })
    }
    pokemonNum2 = (Math.floor(Math.random()*1010)+1).toString()
    if (pokemonNum2 < 1010 && pokemonNum2 == pokemonNum){
        pokemonNum2--
    }
    else if(pokemonNum2 > 0 && pokemonNum2 == pokemonNum){
        pokemonNum2++
    }
    let url2 = `https://pokeapi.co/api/v2/pokemon/${pokemonNum2}`;
    fetch(url2)
    .then(res2 =>res2.json())
    .then(res2 =>{
        const pokemon_opponent = document.querySelector("#pokemon_opponent")
        if(shiny_chance == shiny_check && res2.sprites.front_shiny != null){
            pokemon_opponent.innerHTML = `<p>${res2.name}</p>
        <img src="${res2.sprites.front_shiny}">`
        }
        else{
            pokemon_opponent.innerHTML = `<p>${res2.name}</p>
        <img src="${res2.sprites.front_default}">`
        }
        if (subject==0) {
            pokemon_opponent_value = res2.height
        }
        else if (subject== 1) {
            pokemon_opponent_value = res2.weight
        }
        else if (subject== 2) {
            pokemon_opponent_value = res2.id
        }
        else if (subject== 3) {
            pokemon_opponent_value = res2.stats[0].base_stat
        }
        else if (subject== 4) {
            pokemon_opponent_value = res2.stats[1].base_stat
        }
        else if (subject== 5) {
            pokemon_opponent_value = res2.stats[2].base_stat
        }
        else if (subject== 6) {
            pokemon_opponent_value = res2.stats[3].base_stat
        }
        else if (subject== 7) {
            pokemon_opponent_value = res2.stats[4].base_stat
        }
        // console.log(pokemon_opponent_value)
    })
        if (lose == true){
            const lost = document.querySelector("body")
            lost.innerHTML = `<div id = "lose">
            <p id = "lose_message">YOU GOT A SCORE OF ${points}<p>
             </div>`
        }
    loop++
})
function NextUnlock() {
    const next_button = document.querySelector("#next")
    next_button.innerHTML = `<input type="button" id = "next_css" value="Next">`
}
function Hchoice(){
    NextUnlock()
    const box = document.querySelector("#box")
    box.innerHTML = `<input type="button" id = "ButtonHChoice" value="Higher" onclick="Hchoice()">
    <input type="button" id = "ButtonL" value="Lower" onclick="Lchoice()">`
    if (pokemon_current_value > pokemon_opponent_value && points != stop_points){
        lose = false
        point = true
    }
    else if (pokemon_current_value == pokemon_opponent_value){
        lose = false
        point = false
    }
    else{
        lose = true
        point = false
    }
    // console.log("")
    // console.log("pokemon_current_value:",pokemon_current_value)
    // console.log("pokemon_opponent_value:",pokemon_opponent_value)
    // console.log("lose:",lose)
    // console.log("point",point)
}
function Lchoice(){
    NextUnlock()
    const box = document.querySelector("#box")
    box.innerHTML = `<input type="button" id = "ButtonH" value="Higher" onclick="Hchoice()">
    <input type="button" id = "ButtonLChoice" value="Lower" onclick="Lchoice()">`
    if (pokemon_current_value < pokemon_opponent_value & points != stop_points){
        lose = false
        point = true
    }
    else if (pokemon_current_value == pokemon_opponent_value){
        lose = false 
        point = false
    }
    else{
        lose = true
        point = false
    }
    // console.log("")
    // console.log("pokemon_current_value:",pokemon_current_value)
    // console.log("pokemon_opponent_value:",pokemon_opponent_value)
    // console.log("lose:",lose)
    // console.log("point",point)
}
// function show_values(pokemon_current_value,pokemon_opponent_value,pokemonNum,PokemonNum2){
//     let url = `https://pokeapi.co/api/v2/pokemon/${pokemonNum}`;
//         fetch(url)
//         .then(res =>res.json())
//         .then(res =>{
//         if (subject==0) {
//             pokemon_current_value = (res.height)/10
//             unit = "m"
//         }
//         else if (subject== 1) {
//             pokemon_current_value = (res.weight)/10
//             unit = "kg"
//         }
//         else if (subject== 2) {
//             pokemon_current_value = res.id
//         }
//         else if (subject== 3) {
//             pokemon_current_value = res.stats[0].base_stat
//         }
//         else if (subject== 4) {
//             pokemon_current_value = res.stats[1].base_stat
//         }
//         else if (subject== 5) {
//             pokemon_current_value = res.stats[2].base_stat
//         }
//         else if (subject== 6) {
//             pokemon_current_value = res.stats[3].base_stat
//         }
//         else if (subject== 7) {
//             pokemon_current_value = res.stats[4].base_stat
//         }
//         const pokemon_current = document.querySelector("#pokemon_current")
//         if(shiny_chance == shiny_check && res2.sprites.front_shiny != null){
//             pokemon_current.innerHTML = `<p>${res2.name}</p>
//         <img src="${res2.sprites.front_shiny}">
//         <p>${pokemon_current_value}${unit}<p/>`
//         }
//         else{
//             pokemon_opponent.innerHTML = `<p>${res2.name}</p>
//         <img src="${res2.sprites.front_default}">
//         <p>${pokemon_opponent_value}${unit}<p/>`
//         }
        

//         })
//     let url2 = `https://pokeapi.co/api/v2/pokemon/${pokemonNum2}`;
//     fetch(url2)
//     .then(res2 =>res2.json())
//     .then(res2 =>{
//         if (subject==0) {
//             pokemon_opponent_value = (res2.height)/10
//             unit = "m"
//         }
//         else if (subject== 1) {
//             pokemon_opponent_value = (res2.weight)/10
//             unit = "kg"
//         }
//         else if (subject== 2) {
//             pokemon_opponent_value = res2.id
//         }
//         else if (subject== 3) {
//             pokemon_opponent_value = res2.stats[0].base_stat
//         }
//         else if (subject== 4) {
//             pokemon_opponent_value = res2.stats[1].base_stat
//         }
//         else if (subject== 5) {
//             pokemon_opponent_value = res2.stats[2].base_stat
//         }
//         else if (subject== 6) {
//             pokemon_opponent_value = res2.stats[3].base_stat
//         }
//         else if (subject== 7) {
//             pokemon_opponent_value = res2.stats[4].base_stat
//         }
//         const pokemon_opponent = document.querySelector("#pokemon_opponent")
//         if(shiny_chance == shiny_check && res2.sprites.front_shiny != null){
//             pokemon_opponent.innerHTML = `<p>${res2.name}</p>
//             <img src="${res2.sprites.front_shiny}">
//             <p>${pokemon_opponent_value}${unit}<p/>`
//         }
//         else{
//             pokemon_opponent.innerHTML = `<p>${res2.name}</p>
//             <img src="${res2.sprites.front_default}">
//             <p>${pokemon_opponent_value}${unit}<p/>`
//         }        
//         })
// }