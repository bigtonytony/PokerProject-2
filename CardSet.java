package com.demo;

import java.util.ArrayList;
import java.util.Collection;
import java.util.Collections;
import java.util.HashSet;
import java.util.LinkedList;
import java.util.List;
import java.util.Set;


public class CardSet {

	private List<Card> hands;
	private boolean sameColor;
	private boolean straight;
	private int setType;
	
	public CardSet(CardDeck cardDeck) {
		
		hands = new ArrayList<Card>();
		
		for(int i=0;i<5;i++) //draw 5 cards
			hands.add(cardDeck.drawCard());
	}
	
	public void showSet() {
		
		for(int i=0;i<5;i++)
			System.out.println(hands.get(i).getSuit()+" "+hands.get(i).getCardNumber());
	}
	
	
	public void JudgeSet() {
		
		sameColor=false;
		straight=false;
		setType=0;
		
		List<Integer> setOrder = new ArrayList<Integer>();
		Set<Integer> setSuit = new HashSet<Integer>();
		Set<Integer> setNumber = new HashSet<Integer>();
		
		for(int i=0;i<5;i++) { //judge initial
			
			setOrder.add(new Integer(hands.get(i).getCardNumber()));
			setNumber.add(new Integer(hands.get(i).getCardNumber()));
			setSuit.add(new Integer(hands.get(i).getSuit()));
		}
	
		/*
		for(int i=0;i<5;i++) 
		System.out.println(setOrder.get(i));
		
		System.out.println(setSuit.size());
		System.out.println(setNumber.size());
		*/
		
		//------judge-----
		
		// High card(0)||Straight(6)||Flush Straight(10)
		// One Pair(3)
		// Two Pairs(4)||Three of a kind(5)
		// Full house(8)||Four of a Kind(9)
		// Flush(7)
		
		Collections.sort(setOrder);
		/*for(int i=0;i<5;i++) 
			System.out.println(setOrder.get(i));*/
		
		
		if(setOrder.get(4)-setOrder.get(0)==4) { //straight
			straight=true;
			setType=6;
		} 
			
		
		if(setSuit.size()==1) { //Flush
			sameColor=true;
			setType=7;
		}
		
		if(straight&sameColor) //Flush Straight
			setType=10;
		
		
		if(setType==0) {
			
			switch(setNumber.size()) {
		
			case 5:// High card(0)
				setType=0;
				break;
				
			case 4:// One Pair(3)
				setType=3;
				break;
				
			case 3:// Two Pairs(4)||Three of a kind(5)
				setType=4;//default two pairs
				for(Integer count:setOrder) {
					if(Collections.frequency(setOrder, count)==3)
						setType=5;
				}
				break;
				
			case 2:// Full house(8)||Four of a Kind(9)
				setType=8;//default full house
				for(Integer count:setOrder) {
					if(Collections.frequency(setOrder, count)==4)
						setType=9;
				}
				break;
		
			default:
				System.out.println("Wrong!");
				break;
			}
		}
	}//judge end
	
	public List<Card> getHands() {
		return hands;
	}

	public void setHands(List<Card> hands) {
		this.hands = hands;
	}

	public int getSetType() {
		return setType;
	}

	public void setSetType(int setType) {
		this.setType = setType;
	}

	
}
