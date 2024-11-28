"use strict";
console.clear();
/*************************************************************
 * Create classes and variables to do with cards and field   *
 *************************************************************/
const foundation = ["f1", "f2", "f3", "f4"];
const tableau = ["a1", "a2", "a3", "a4", "a5", "a6", "a7"];
const pile = ["wp", "st", "currentTableau"];

const suits = ["spades", "hearts", "clubs", "diams"];
const ranks = ["A", 2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K"];
const winner = document.getElementById("winner");

let currentBoard = {
  currentTableau: [],
  f1: [],
  f2: [],
  f3: [],
  f4: [],
  wp: [],
  stock: []
};
let currentlySelected = [];
let highlighted;
let playingDeck;
let placeholder = 0;
let tempDeck = {
  cards: [],
  numCards: 0
};

class Card {
  constructor(suit, rank) {
    this.suit = suit;
    this.rank = rank;
    this.faceUp = false;
    this.played = false;
  }
}
class Deck {
  constructor() {
    this.cards = Deck.generateDeck();
    this.numCards = this.cards.length;
  }

  //create a deck of cards
  static generateDeck() {
    let deck = [];
    for (let suit in suits)
      for (let rank in ranks) deck.push(new Card(suits[suit], ranks[rank]));

    let i, j, temp;
    for (i = deck.length - 1; i > 0; i--) {
      j = Math.floor(Math.random() * (i + 1));
      temp = deck[i];
      deck[i] = deck[j];
      deck[j] = temp;
    }

    return deck;
  }
}

/*************************************************************
 * Displays cards                                            *
 *************************************************************/
function clearBoard() {
  const removeCards = (elms) => elms.forEach((el) => el.remove());
  removeCards(document.querySelectorAll(".card"));
  removeCards(document.querySelectorAll(".cardback"));
}
function createCard(id, suit, rank) {
  let red = suit == "diams" || suit == "hearts" ? "red" : "";
  let stacked = document.getElementById(id).innerHTML ? "stacked" : "";
  let card = "";

  if (suit == undefined || rank == undefined) {
    card = `<div class="cardback ${stacked}"><div class="contents">
              <div class="card-content">&#9733;</div>
            </div>
            </div>`;
  } else {
    card = `<div class="card ${red} ${stacked}" onClick="selectCard(this,this.parentNode)" rank="${rank}" suit="${suit}"><div class="contents">
              <div class="card-top">${rank}&${suit};</div>
              <div class="card-content"> &${suit};</div>
            </div>
            </div>`;
  }

  addToTableau(id, card);
}
function addToTableau(id, cardHtml) {
  switch (id) {
    case "f1":
    case "f2":
    case "f3":
    case "f4":
    case "wp":
      document.getElementById(id).innerHTML = cardHtml;
      break;
    default:
      document.getElementById(id).innerHTML += cardHtml;
  }
}
function redrawBoard() {
  clearBoard();
  //Tableau
  for (let column in currentBoard.currentTableau) {
    for (let card in currentBoard.currentTableau[column]) {
      if (currentBoard.currentTableau[column][card].faceUp)
        createCard(
          tableau[column],
          currentBoard.currentTableau[column][card].suit,
          currentBoard.currentTableau[column][card].rank
        );
      else {
        //flip card if last card, otherwise it stays facedown
        //if the last card in the column isn't facedup, flip it
        if (card == currentBoard.currentTableau[column].length - 1) {
          if (!currentBoard.currentTableau[column][card].faceUp) {
            currentBoard.currentTableau[column][card].faceUp = true;
            createCard(
              tableau[column],
              currentBoard.currentTableau[column][card].suit,
              currentBoard.currentTableau[column][card].rank
            );
          }
        } else createCard(tableau[column]);
      }
    }
  }

  //foundation Stock and Waste Pile
  if (currentBoard.f1.length > 0) {
    createCard(
      foundation[0],
      currentBoard.f1[currentBoard.f1.length - 1].suit,
      currentBoard.f1[currentBoard.f1.length - 1].rank
    );
  }
  if (currentBoard.f2.length > 0) {
    createCard(
      foundation[1],
      currentBoard.f2[currentBoard.f2.length - 1].suit,
      currentBoard.f2[currentBoard.f2.length - 1].rank
    );
  }
  if (currentBoard.f3.length > 0) {
    createCard(
      foundation[2],
      currentBoard.f3[currentBoard.f3.length - 1].suit,
      currentBoard.f3[currentBoard.f3.length - 1].rank
    );
  }
  if (currentBoard.f4.length > 0) {
    createCard(
      foundation[3],
      currentBoard.f4[currentBoard.f4.length - 1].suit,
      currentBoard.f4[currentBoard.f4.length - 1].rank
    );
  }
  if (
    currentBoard.wp.length > 0 &&
    currentBoard.wp[currentBoard.wp.length - 1] != undefined
  ) {
    createCard(
      pile[0],
      currentBoard.wp[currentBoard.wp.length - 1].suit,
      currentBoard.wp[currentBoard.wp.length - 1].rank
    );
  }
  createCard(pile[1]);
}
function setupGame() {
  let deckProperties = Object.keys(playingDeck.cards);
  deckProperties.forEach((item) => {
    tempDeck.cards[item] = playingDeck.cards[item];
    tempDeck.cards[item].faceUp = false;
  });
  tempDeck.numCards = playingDeck.numCards;

  createCard(pile[1]);
  for (let i = 0; i <= 6; i++) {
    let col = [];
    for (let j = 0; j <= i; j++) {
      if (j == i) {
        //create face up card using the top card in the deck
        createCard(tableau[i], tempDeck.cards[0].suit, tempDeck.cards[0].rank);
        tempDeck.cards[0].faceUp = true;
      } else createCard(tableau[i]);

      //add the card to the tableau, so we can keep track of faced down cards
      col.push(tempDeck.cards.shift());
      tempDeck.numCards--;
    }
    currentBoard.currentTableau.push(col);
  }

  currentBoard.stock = tempDeck;
}

/*************************************************************
 * Lets Play!                                                *
 *************************************************************/

function newGame() {
  //clear board first
  let boardProperties = Object.keys(currentBoard);
  boardProperties.forEach((item) => (currentBoard[item] = []));

  currentlySelected = [];
  placeholder = 0;

  clearBoard();
  winner.style.display == "block" ? (winner.style.display = "none") : "";

  playingDeck = new Deck();
  //populate the board
  if (playingDeck != undefined) setupGame();
}
function restartGame() {
  //clear board first
  let boardProperties = Object.keys(currentBoard);
  boardProperties.forEach((item) => (currentBoard[item] = []));

  currentlySelected = [];
  placeholder = 0;

  clearBoard();
  if (playingDeck != undefined) setupGame();
}
function selectCard(elem, parent) {
  let idx = parent.getAttribute("id").charAt(1) - 1;
  let selection = [elem.getAttribute("rank"), elem.getAttribute("suit")];
  let area = parent.getAttribute("id").match(/^a/)
    ? pile[2]
    : parent.getAttribute("id");
  let cardInfo = {
    area: area,
    card: getCard(selection[0], selection[1], idx, area),
    location: idx
  };

  currentlySelected.push(cardInfo);
  if (currentlySelected.length == 2) {
    if (compareCards(currentlySelected[0], currentlySelected[1])) {
      moveStack(currentlySelected[0], currentlySelected[1]);
      redrawBoard();
    } else {
      highlighted.style.backgroundColor = "";
    }

    currentlySelected = [];
  }

  // highlight the first selected card
  if (currentlySelected.length == 1) {
    if (checkForAceOrKing(cardInfo)) {
      elem.remove();
      currentlySelected = [];
    } else {
      elem.style.backgroundColor = "#2ac9d2";
      highlighted = elem;
    }
  }
}
function getCard(rank, suit, idx, location) {
  if (location == pile[2]) {
    for (let card in currentBoard[location][idx]) {
      if (
        currentBoard[location][idx][card].rank == rank &&
        currentBoard[location][idx][card].suit == suit
      )
        return currentBoard[location][idx][card];
    }
  } else {
    idx = currentBoard[location].length - 1;
    if (
      currentBoard[location][idx].rank == rank &&
      currentBoard[location][idx].suit == suit
    )
      return currentBoard[location][idx];
  }
}
function compareCards(card1, card2) {
  let rank2Num = {
    A: 1,
    K: 13,
    Q: 12,
    J: 11
  };

  let rank1 =
    typeof card1.card.rank == "string"
      ? rank2Num[card1.card.rank]
      : card1.card.rank;
  let rank2 =
    typeof card2.card.rank == "string"
      ? rank2Num[card2.card.rank]
      : card2.card.rank;
  let color1 =
    card1.card.suit == "spades" || card1.card.suit == "clubs" ? "black" : "red";
  let color2 =
    card2.card.suit == "spades" || card2.card.suit == "clubs" ? "black" : "red";

  if (card2.area != pile[2]) {
    return --rank1 == rank2 && card2.card.suit == card1.card.suit;
  }

  return ++rank1 == rank2 && color1 != color2;
}
function moveStack(currentCard, destinationCard) {
  let stack = [];
  if (currentCard.area == pile[2]) {
    let length =
      currentBoard[currentCard.area][currentCard.location].length - 1;

    //store the stack to be moved
    for (
      let i = length;
      currentCard.card != currentBoard.currentTableau[currentCard.location][i];
      i--
    ) {
      stack.unshift(currentBoard.currentTableau[currentCard.location].pop());
    }
    stack.unshift(currentBoard.currentTableau[currentCard.location].pop()); //get the current card in the stack

    //move the stack
    if (destinationCard.area == pile[2]) {
      stack.forEach((item) => {
        currentBoard[destinationCard.area][destinationCard.location].push(item);
      });
    } else currentBoard[destinationCard.area].push(stack.pop()); // moving to foundation
  } else {
    stack.unshift(currentBoard[currentCard.area].pop()); //store card from either foundation or waste pile
    if (currentCard.area == pile[0]) {
      currentBoard.stock.numCards--;
      //remove from stock pile as well
      for (let card in currentBoard.stock.cards) {
        if (currentBoard.stock.cards[card] == currentCard.card) {
          currentBoard.stock.cards.splice(card, 1);
          currentBoard.stock.numCards = currentBoard.stock.cards.length;
          placeholder--;
        }
      }
    }
    if (destinationCard.area == pile[2])
      currentBoard[destinationCard.area][destinationCard.location].push(
        stack.pop()
      );
    //add to tableau
    else currentBoard[destinationCard.area].push(stack.pop()); //add to foundation
  }

  isGameWon();
}
function checkForAceOrKing(cardInfo) {
  let cT = currentBoard.currentTableau;

  if (cardInfo.card.rank == ranks[0]) {
    for (let f in foundation) {
      //if suit is already in foundation, return false
      if (currentBoard[foundation[f]].length != 0)
        if (cardInfo.card.suit == currentBoard[foundation[f]][0].suit)
          return false;
    }

    for (let f in foundation) {
      if (currentBoard[foundation[f]].length == 0) {
        //if there are no cards in foundation[f]
        currentBoard[foundation[f]].push(cardInfo.card); //add to the foundation
        if (cardInfo.area == pile[2]) {
          for (let card in cT[cardInfo.location]) {
            if (
              cT[cardInfo.location][card].rank == cardInfo.card.rank &&
              cT[cardInfo.location][card].suit == cardInfo.card.suit
            ) {
              cT[cardInfo.location].splice(card); //remove card from Tableau
            }
          }
        } else {
          //card is from waste pile, so remove from waste pile
          let idx = currentBoard[cardInfo.area].length - 1;
          currentBoard[cardInfo.area].splice(idx);
          //remove from stock array
          for (let card in currentBoard.stock.cards) {
            if (currentBoard.stock.cards[card] == cardInfo.card) {
              currentBoard.stock.cards.splice(card, 1);
              currentBoard.stock.numCards = currentBoard.stock.cards.length;
              placeholder--;
            }
          }
        }

        redrawBoard();
        return true;
      }
    }
  }

  if (cardInfo.card.rank == ranks[12]) {
    for (let place in cT) {
      if (cT[place].length == 0) {
        moveStack(cardInfo, {
          area: pile[2],
          location: place,
          card: undefined
        });
        redrawBoard();
        return true;
      }
    }
  }

  return false;
}
function searchStock() {
  let stack = currentBoard.stock;
  let card = stack.cards[placeholder];

  if (stack.numCards - 1 > placeholder) placeholder++;
  else {
    placeholder = 0;
    currentBoard.wp = [];
  }

  currentBoard.wp.push(card);
  redrawBoard();
}
function isGameWon() {
  let finishedStacks = 0;
  for (let f in foundation) {
    let currentFoundation = currentBoard[foundation[f]];
    let idx = currentFoundation.length;

    if (idx == 0) return false;
    if (currentFoundation[idx - 1].rank != ranks[11]) return false;
    else finishedStacks++;
  }

  if (finishedStacks == 4) {
    winner.style.display = "block";
    return true;
  }

  return false;
}
