document.addEventListener("DOMContentLoaded", () => {
    let debug = false;
    let word = '';
    let unltd = true;
    // we can either show thanks/share mesaging in a pane (true), or redirect to a url (false)
    let localEndMesg = false;
    
    if (typeof tfi !== 'undefined') {
        word = furdleVocab[tfi];
        if(debug){
            console.log(`Is this is an unlimited game? ${ unltd }`);
            console.log(`Today's word is ${ word }.`);
        }
    } else {
        word = furdleVocab[Math.floor(Math.random() * furdleVocab.length)];
        //word = furdleVocab[13];
        unltd = true;
        if(debug){
            console.log(`Is this is an unlimited game? ${ unltd }`);
            console.log(`Today's word is ${ word }.`);
        }
    }

    const btnHelp =  document.getElementById('btn_help');
    const btnInfo =  document.getElementById('btn_info');
    const btnPlayAgain =  document.getElementById('btn_play_again');
    //const lnkHelp  =  document.getElementById('lnk_help');
    const overlayHelp =  document.getElementById('help_overlay_container');
    const overlayInfo =  document.getElementById('info_overlay_container');
    const overlayEnd =  document.getElementById('end_overlay_container');
    const overlayEndHeadline =  document.getElementById('end_overlay_headline');
    const overlayEndMessage =  document.getElementById('end_overlay_message');
    const overlayEndShareImg =  document.getElementById('share_img');
    const overlayPlayed =  document.getElementById('played_overlay_container');
    const overlayPlayedHeadline =  document.getElementById('played_overlay_headline');
    const overlayShareImg =  document.getElementById('played_overlay_share');
    const end_redirect_base = 'https://furdle.us/';

    let guessCount = 0;
    let shareImages = ['share-1.jpg','share-2.jpg','share-3.jpg','share-4.jpg','share-5.jpg','share-6.jpg','share-6x.jpg'];

    const currentPlayer = 'thisPlayer2113';

    if(!unltd) {
        const player = getPlayerInfo(currentPlayer);
        if(debug){
            console.log(`player? =  ${ player }`);
        }
        if (player) {
            if(player.todaysWord === word) {
                if(debug){
                    console.log(`word is ${ word }`);
                    console.log(`todaysWord is ${ player.todaysWord }`);
                    console.log(`todaysWord === word`);
                    console.log(`noOfGuesses is ${ player.noOfGuesses }`);
                    console.log(`playedToday is ${ player.playedToday }`);
                    console.log(`You have already finished today's Furdle.  You can play again in ${ player.hms }`);
                }
                const shareImg = `/img/${ shareImages[player.noOfGuesses-1] }`;
                overlayShareImg.setAttribute('src',shareImg);
                overlayPlayedHeadline.textContent = `You have already finished today's Furdle.  You can play again in ${ player.hms }.`;
                overlayPlayed.style.zIndex = '10';
                overlayPlayed.style.visibility = 'visible';
                overlayPlayed.classList.add('fadeIn');
            } else {
                localStorage.clear();
            }
        } else {
            if(debug){
                console.log(`You have not Furdled yet today. Have fun.`);
            }
        }
    }

    const tileDisplay = document.getElementById('tile_container');
    
    const messageDisplay = document.getElementById('message_display');
    const msgSuccessHeadline = "Bingo!  You got it!";
    //const msgSuccessBody = "Add messaging for users who solve";
    const msgTryAgainHeadline = "Sorry, cats have nine lives, but you only have six guesses.";
    const msgTryAgainBody = `The Furdle was <strong>${ word }</strong>.`;
    const msgMoreLetters = "Please enter a 5 letter word.";
    const msgInvalidKEy = "Please enter a letter.";
    const msgWordUnrecognized = "Sorry, please enter a valid word.";

    const counterFallbackContent = "6,000+"

    const actionLinksFallbackContent = '<a target="_blank" href="https://furdle.us/">Take action for animals</a>';

    const keyboard = document.getElementById('keyboard_container')
    const keyEnterSVG = '<svg id="key_enter_svg" width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.9131 13.6641L0.975603 10.0078C0.624041 9.69141 0.624041 9.09375 0.975603 8.77734L4.9131 5.12109C5.1592 4.875 5.51076 4.83984 5.82717 4.98047C6.14357 5.08594 6.35451 5.40234 6.35451 5.75391L6.31935 8.53125H17.0069V1.21875C17.0069 0.761719 17.3584 0.375 17.8506 0.375C18.3076 0.375 18.6944 0.761719 18.6944 1.21875V9.375C18.6944 9.86719 18.3076 10.2188 17.8506 10.2188H6.31935V13.0312C6.31935 13.3828 6.10842 13.6992 5.79201 13.8047C5.4756 13.9453 5.1592 13.9102 4.9131 13.6641Z" fill="#889933"/></svg>'
    const keyDeleteSVG = '<svg id="key_delete_svg" width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.6045 0.5H7.81154C7.21388 0.5 6.65138 0.746094 6.22951 1.16797L0.920916 6.47656C0.463884 6.89844 0.463884 7.63672 0.920916 8.05859L6.22951 13.3672C6.65138 13.7891 7.21388 14 7.81154 14H18.6045C19.835 14 20.8545 13.0156 20.8545 11.75V2.75C20.8545 1.51953 19.835 0.5 18.6045 0.5ZM19.167 11.75C19.167 12.0664 18.8858 12.3125 18.6045 12.3125H7.81154C7.67092 12.3125 7.53029 12.2773 7.38967 12.1719L2.50295 7.25L7.38967 2.36328C7.49513 2.25781 7.63576 2.1875 7.81154 2.1875H18.6045C18.8858 2.1875 19.167 2.46875 19.167 2.75V11.75ZM15.792 4.40234C15.4404 4.08594 14.9131 4.08594 14.5967 4.40234L12.9795 6.08984L11.292 4.4375C10.9756 4.08594 10.4483 4.08594 10.1319 4.4375C9.78029 4.75391 9.78029 5.28125 10.1319 5.63281L11.7842 7.28516L10.1319 8.90234C9.78029 9.25391 9.78029 9.78125 10.1319 10.0977C10.4483 10.4492 10.9756 10.4492 11.292 10.0977L12.9795 8.44531L14.6319 10.0977C14.9483 10.4492 15.4756 10.4492 15.792 10.0977C16.1436 9.78125 16.1436 9.25391 15.792 8.90234L14.1397 7.25L15.792 5.59766C16.1436 5.28125 16.1436 4.75391 15.792 4.40234Z" fill="#CC3300"/></svg>'
    
    const keys = ['q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','enter','z','x','c','v','b','n','m','delete']

    const guessRows = [
        ['', '', '', '', ''],
        ['', '', '', '', ''],
        ['', '', '', '', ''],
        ['', '', '', '', ''],
        ['', '', '', '', ''],
        ['', '', '', '', '']
    ]

    let currentRow = 0
    let currentTile = 0
    let isGameOver = false

    guessRows.forEach((guessRow, guessRowIndex) => {
        const rowElement = document.createElement('div')
        rowElement.classList.add('tile-row')
        rowElement.setAttribute('id', 'guessRow_' + guessRowIndex)
        guessRow.forEach((guess, guessIndex) => {
            const tileElement = document.createElement('div')
            tileElement.setAttribute('id', 'guessRow_' + guessRowIndex + '_tile_' + guessIndex)
            tileElement.classList.add('tile')
            rowElement.append(tileElement)
        })
        tileDisplay.append(rowElement)
    })

    let rowElement = ''
    let rowElementNumber = 1
    keys.forEach((key) => {
        if(key === 'q' || key === 'a' || key === 'enter') {
            rowElement = document.createElement('div')
            rowElement.classList.add('key-row')
            rowElement.setAttribute('id', 'key_row_' + rowElementNumber)
            keyboard.append(rowElement)
            rowElementNumber++
        }
        const buttonElement = document.createElement('button')
        if(key === "enter"){
            buttonElement.innerHTML = keyEnterSVG
        } else if(key === "delete"){
            buttonElement.innerHTML = keyDeleteSVG
        } else {
            buttonElement.innerHTML = key
        }
        buttonElement.setAttribute('id', 'key_' + key)
        buttonElement.setAttribute('data-key', key)
        buttonElement.addEventListener('click', () => handleKeyButtonClick(key))
        rowElement.append(buttonElement)
    })

    const handleKeyButtonClick = (key) => {
        key = key.toLowerCase()
        if(key === 'delete') {
            deleteLetter()
            return;
        }
        if(key === 'enter') {
            checkRow()
            return;
        }
        if(!keys.includes(key)) {
            return;
        }
        addLetter(key)
    }

    const addLetter = (letter) => {
        if(currentTile < 5 && currentRow < 6){
            const tile = document.getElementById('guessRow_' + currentRow + '_tile_' + currentTile)
            tile.textContent = letter;
            guessRows[currentRow][currentTile] = letter
            tile.setAttribute('data', letter)
            currentTile++
        }
    }

    const deleteLetter = () => {
        if(debug){
            console.log(`isGameOver = ${ isGameOver }`);
        }
        if(currentTile > 0 && !isGameOver ) {
            currentTile--
            const tile = document.getElementById('guessRow_' + currentRow + '_tile_' + currentTile)
            tile.textContent = '';
            guessRows[currentRow][currentTile] = ''
            tile.setAttribute('data', '')
        }
    }

    const checkRow = () => {
        const guess = guessRows[currentRow].join('')
        if (guess.length === 5 && furdleGuesses.includes(guess) ) {
            flipTile()
            if (currentTile > 4) {
                guessCount++
                if (word == guess) {
                    isGameOver = true;
                    if(!unltd) {
                        savePlayerInfo(currentPlayer, guessCount, isGameOver, word);
                    }
                    if(localEndMesg) {
                        showEndMessage(msgSuccessHeadline);
                    } else {
                        redirectEndMessage(currentRow);
                    }
                    countGamesCompleted();
                    return
                } else {
                    if (currentRow >= 5) {
                        isGameOver = true;
                        if(!unltd) {
                            savePlayerInfo(currentPlayer, guessCount, isGameOver, word);
                        }
                        if(localEndMesg) {
                            showEndMessage(msgSuccessHeadline);
                        } else {
                            redirectEndMessage(currentRow + 1);
                        }
                        countGamesCompleted();
                        return
                    }
                    if (currentRow < 5) {
                        isGameOver = false;
                        if(!unltd) {
                            savePlayerInfo(currentPlayer, guessCount, isGameOver, word);
                        }
                        currentRow++;
                        currentTile = 0;
                    }
                }
                if(debug){
                    console.log("getPlayerInfo: " + getPlayerInfo(currentPlayer));
                }
            }
            
        } else {
            if(guess.length < 5) {
                showMessage(msgMoreLetters)
            } else if(!furdleGuesses.includes(guess)) {
                showMessage(msgWordUnrecognized)
            }
        }
    }

    const showMessage = (message) => {
        messageDisplay.classList.remove('fade')
        const thisRow = `guessRow_${ currentRow }` 
        const thisRowError = document.getElementById(thisRow);
        if(debug){
            console.log(`current row is ${ currentRow }`);
        }
        thisRowError.classList.add('slide-left')
        messageDisplay.innerHTML = ''
        const messageElement = document.createElement('p')
        messageElement.textContent = message
        messageDisplay.append(messageElement)
        // add fadeout of message
        setTimeout(() => {
            messageDisplay.classList.add('fade')
            thisRowError.classList.remove('slide-left');
        }, 2000)
    }

    // ping basic counter
    const countGamesCompleted = () => {
        let gameCount = new XMLHttpRequest();
        gameCount.open('GET', 'https://furdle.us/game/php/counter.php', true);
    
        gameCount.onload = function() {
            if (gameCount.status >= 200 && gameCount.status < 400) {
                let resp = gameCount.responseText;  
                let parser = new DOMParser();
                let htmlDoc = parser.parseFromString(resp,"text/html");
                if(debug){
                    console.log(htmlDoc);
                }
            }
        };
        gameCount.onerror = function() {};
        gameCount.send();
    }

    const updateShareMeta = (text, img) => {
        let shareImg = `https://furdle.us/${ img }`
        let ogImg = document.querySelector('meta[property="og:image"]').setAttribute("content", shareImg);
        let twImg = document.querySelector('meta[name="twitter:image"]').setAttribute("content", shareImg);
    }

    const showEndMessage = (message) => {
        let headlineContent = '';
        let endShareImg = `/img/${ shareImages[currentRow] }`;
        if(message === msgSuccessHeadline) {
            headlineContent = msgSuccessHeadline
            //messageContent = msgSuccessBody
        } else if(message === msgTryAgainHeadline) {
            headlineContent = msgTryAgainHeadline;
            overlayEndMessage.innerHTML = msgTryAgainBody;
            endShareImg = `/img/${ shareImages[shareImages.length - 1] }`;
        }
        overlayEndHeadline.textContent = headlineContent;
        overlayEndShareImg.setAttribute('src',endShareImg);
        updateShareMeta(headlineContent, endShareImg);
        setTimeout(() => {
            if(debug){
                console.log('fired');
            }
            overlayEnd.style.zIndex = '10';
            overlayEnd.style.visibility = 'visible';
            overlayEnd.classList.add('fadeIn');
        }, 4000);
    }

    const reDirect = (url) => {
        if(url){
            if(url==='try_again'){
                window.location.href = end_redirect_base + 'gg_' + url + '?f=' + word;
            } else {
                window.location.href = end_redirect_base + 'gg_' + url;
            }
        } else {
            window.location.href = end_redirect_base;
        }
    }

    const redirectEndMessage = (guesses) => {
        guesses = guesses + 1;
        if(debug){
            console.log(`guesses = ${ guesses } (called from inside redirectEndMessage)`)
        }
        //
        setTimeout(() => {
            if(debug){
                console.log('fired');
            }
            if(guesses >= 1 && guesses <= 6) {
                reDirect(guesses);
            } else {
                reDirect('try_again');
            }
        }, 4000);
        //
    }

    const addStyleToKey = (keyLetter, style) => {
        const keyID = 'key_' + keyLetter
        const key = document.getElementById(keyID)
        key.classList.add(style)
    }

    const flipTile = () => {
        const rowTiles = document.getElementById('guessRow_' + currentRow).childNodes
        let checkWord = word
        const guess = []

        rowTiles.forEach(tile => {
            guess.push({ letter: tile.getAttribute('data'), style: 'incorrect' })
        })

        guess.forEach((guess, index) => {
            if (guess.letter == word[index]){
                guess.style = 'correct'
                checkWord = checkWord.replace(guess.letter, '')
            }
        })

        guess.forEach(guess => {
            if (checkWord.includes(guess.letter)) {
                guess.style = 'close'
                checkWord = checkWord.replace(guess.letter, '')
            }
        })

        rowTiles.forEach((tile, index) => {
            setTimeout(() => {
                tile.classList.add('flip')
                tile.classList.add(guess[index].style)
                addStyleToKey(guess[index].letter, guess[index].style)
            }, 500 * index)
        })

    }
    function debugMessage(msg){
        debug = document.getElementById('debug');
        debug.textContent = msg;
    }

    // add close clicks to all close buttons
    document.querySelectorAll('.btn-close').forEach(item => {
        item.addEventListener('click', event => {
          let container = item.closest(".overlay-container")
          // modals are toggled by animating opacity, and toggling visibility and z-index
          container.classList.remove('fadeIn');
          container.classList.add('fadeOut');
          event.preventDefault();
          setTimeout(() => {
            container.style.visibility = 'none';
            container.style.zIndex = '-10';
            container.classList.remove('fadeOut');
          }, 250)
        })
      })
      

    btnHelp.addEventListener('click', function (event) {
        overlayHelp.style.zIndex = '10';
        overlayHelp.style.visibility = 'visible';
        overlayHelp.classList.add('fadeIn');
        event.preventDefault();
    }, false);

/*     lnkHelp.addEventListener('click', function (event) {
        overlayHelp.style.zIndex = '10';
        overlayHelp.style.visibility = 'visible';
        overlayHelp.classList.add('fadeIn');
        event.preventDefault();
    }, false); */

    btnInfo.addEventListener('click', function (event) {
        overlayInfo.style.zIndex = '10';
        overlayInfo.style.visibility = 'visible';
        overlayInfo.classList.add('fadeIn');
        event.preventDefault();
    }, false);

    btnPlayAgain.addEventListener('click', function (event) {
        window.location.reload(true)
        event.preventDefault();
    }, false);

    // slideshow

    function simpleRotator(rotator) {
        let nextBtn = document.querySelector(`${ rotator } .nav .next`)
        let prevBtn = document.querySelector(`${ rotator }  .nav .prev`)
        let slide = document.querySelectorAll(`${ rotator }  .panels .block`)
        let i = 0
   
        prevBtn.onclick = (event) => {
            event.preventDefault();
        
            slide[i].classList.remove("active");
            i--;
        
            if (i < 0) {
                i = slide.length - 1;
            }
            slide[i].classList.add("active");
        };
    
        nextBtn.onclick = (event) => {
            event.preventDefault();
        
            slide[i].classList.remove("active");
            i++;
        
            if (i >= slide.length) {
                i = 0;
            }
        
            slide[i].classList.add("active");
        };
    
        slider_callback();
        let sliderInterval = window.setInterval(slider_callback, 5000);
    
        function slider_callback() {
            nextBtn.click();
        }
    }
    simpleRotator('.rotator-header')
    simpleRotator('.rotator-footer')

    // save game info to user device

   //
   function msToHMS(ms) {
    const seconds = Math.floor((ms / 1000) % 60);
    const minutes = Math.floor((ms / 1000 / 60) % 60);
    const hours = Math.floor((ms / 1000 / 60 / 60) % 24);
    const hmsTime = [
        hours.toString().padStart(2, "0"),
        minutes.toString().padStart(2, "0"),
        seconds.toString().padStart(2, "0")
    ].join(":")
    return hmsTime
    }

    function savePlayerInfo(key, noOfGuesses, playedToday, todaysWord) {
        const now = new Date();
        const noofguesses = noOfGuesses;
        const playedtoday = playedToday;
        const gametime = now.getTime();
        const midnight = now.setHours(24,0,0,0);
        const timeTilReset = msToHMS(midnight - gametime);
        const todaysword = todaysWord;
        //const DoneForToday ;

        // `item` is an object which contains the original value
        // as well as the time when it's supposed to expire
        const item = {
            noOfGuesses: noofguesses,
            playedToday: playedtoday,
            gameTime: gametime,
            hms: timeTilReset,
            todaysWord: todaysword
        }
        localStorage.setItem(key, JSON.stringify(item))
        if(debug){
            console.log("midnight: " + midnight)
            console.log("gametime: " + gametime)
            console.log("timeTilReset: " + timeTilReset)
        }
    }

    function getPlayerInfo(key) {
        const itemStr = localStorage.getItem(key)
        if (!itemStr) {
            return null;
        };
        const item = JSON.parse(itemStr);
        return item
    }

    function numberWithCommas(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    // key capture
    window.addEventListener("keydown", function (keyboardkeydown) {

        if (keyboardkeydown.defaultPrevented) {
          return; // do nothing if event was already processed
        }

        let key = keyboardkeydown.key.toLowerCase()

        if(key === 'backspace'){
            key = 'delete'
        }

        if(key === 'return'){
            key = 'enter'
        }

        if (keys.includes(key)) {
            if(debug){
                console.log(key);
            }
            if(key === 'delete') {
                if(debug){
                    console.log('delete or backspace key');
                }
                deleteLetter()
                return;
            }
            if(key === 'enter') {
                if(debug){
                    console.log('enter or return key');
                }
                checkRow()
                return;
            }
            addLetter(key)
        } else {
            showMessage(msgInvalidKEy);
        }
        // cancel the default action to avoid handling twice
        keyboardkeydown.preventDefault();
      }, true);

   
    // display total games played, grab from: 
    let gameCountRequest = new XMLHttpRequest();
    gameCountRequest.open('GET', '/themes/custom/b5_furdle/php/player_count.txt', true);

    gameCountRequest.onload = function() {
        if (gameCountRequest.status >= 200 && gameCountRequest.status < 400) {
            let resp = gameCountRequest.responseText;  
            let parser = new DOMParser();
            let htmlDoc = parser.parseFromString(resp,"text/html");
            let gameCount = resp;
            if(debug){
                console.log(`counter? ${ gameCount }`);
            }
            document.getElementById('header_count_number').textContent = numberWithCommas(gameCount);
        } else {
            document.getElementById('header_count_number').textContent = counterFallbackContent;
        }
    };
    gameCountRequest.onerror = function() {};
    gameCountRequest.send();

    function liRotator(rotator) {
        let slide = document.querySelectorAll(`${ rotator } > li`)
        if(debug){
            console.log(`slide = ${ slide }`)
        }
        let i = 0
    
        AdvanceSlide = (event) => {
            //event.preventDefault();
            if(debug){
                console.log(`slide[i].innerHTML = ${ slide[i].innerHTML }`)
            }
            let slideClasses = slide[i].classList;
            if(slideClasses){
                slide[i].classList.remove("active");
            }
            i++;
        
            if (i >= slide.length) {
                i = 0;
            }
        
            slide[i].classList.add("active");
        };
    
        slider_callback();
        let sliderInterval = window.setInterval(slider_callback, 5000);
    
        function slider_callback() {
            AdvanceSlide();
        }
    }


        // display action links in rotator, grab from:
        let actionLinksRequest = new XMLHttpRequest();
        actionLinksRequest.open('GET', '/', true);
        actionLinksRequest.onload = function() {
            if (actionLinksRequest.status >= 200 && actionLinksRequest.status < 400) {
                let resp = actionLinksRequest.responseText;  
                let parser = new DOMParser();
                let htmlDoc = parser.parseFromString(resp,"text/html");
                let actionLinks = resp;
                actionLinks = htmlDoc.querySelector('.wp-block-post-content ul').innerHTML;
                document.getElementById('lnk_action_wrap').innerHTML = actionLinks;
                liRotator('#lnk_action_wrap');

            } else {
                //document.getElementById('action_link').innerHTML = actionLinksFallbackContent;
                if(debug){
                    console.log(`actionLinks: failed`);
                }
            }
        };
        actionLinksRequest.onerror = function() {
        };
        actionLinksRequest.send();

})