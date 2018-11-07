package com.demo;

import java.util.Iterator;
import java.util.LinkedList;
import java.util.List;
import java.util.Random;


public class CardDeck {
	
	private List<Card> cardDeck;
	
	public CardDeck() {
		cardDeck = new LinkedList<Card>();
		
		
		for(int i=0;i<52;i++) {
			
			Card card=new Card();
			card.setCardNumber(i%13+1);
			card.setSuit((int)Math.ceil(i/13)+1);
			cardDeck.add(card);
		}
		
	} //initial cardDeck


	public void shuffle() {
		
		List<Card> shuffleCardDeck =new LinkedList<Card>();
		Random random = new Random();
		
		while(!cardDeck.isEmpty()) {
			
			int index=random.nextInt(cardDeck.size());
			shuffleCardDeck.add(cardDeck.get(index));
			cardDeck.remove(index);
		}
		
		cardDeck=shuffleCardDeck;
	}
	
	
	public void showDeck() {
		
		Card tempCard=new Card();
		
		Iterator<Card> it;
		it=cardDeck.iterator();
		
		while (it.hasNext()) {
			
			tempCard=it.next();
			System.out.println(tempCard.getSuit()+" "+tempCard.getCardNumber());
		}
		
	}
	
	public Card drawCard() {
		
		if(!cardDeck.isEmpty()) {
			
			Card tempCard=new Card();
			tempCard=cardDeck.get(0);
			cardDeck.remove(0);
			return tempCard;
		}
		else
			return null;
		
	}
	
	public List<Card> getCardDeck() {
		return cardDeck;
	}
	
	public void setCardDeck(List<Card> cardDeck) {
		this.cardDeck = cardDeck;
	}
}

