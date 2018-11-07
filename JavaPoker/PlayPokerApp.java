package com.demo;

public class PlayPokerApp {

	public static void main(String[] args) {
		
		CardDeck cardDeck = new CardDeck();
		
		//cardDeck.showDeck();
		
		cardDeck.shuffle();

		//cardDeck.showDeck();

		CardSet cardSet = new CardSet(cardDeck);
		
		cardSet.showSet();
		
		cardSet.JudgeSet();
		System.out.println(cardSet.getSetType());
		
	}

}
