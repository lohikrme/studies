#Bakteerit jakautuu kerran aikasyklissä, 
#seurauksena on aina yksi ”vastasyntynyt” bakteeri. 
#Vastasyntynyt tulee ”sukukypsäksi” 3 aikasyklin jälkeen 
#ja alkaa sitten jakautua. 

#Kirjoita funktio joka antaa vastauksen montako bakteeria 
#on N aikasyklin jälkeen missä N on funktioille annettava parametri. 

#Eli numerot menisi:
#t(0): 1
#t(1): 2
#t(2): 3
#t(3): 4
#t(4): 6
#t(5): 9

def bacteria (time):


    babies = 0
    kids = 0
    adolescents = 0
    adults = 1
    time2 = time

    if time > 0 or time <= 100:
        while time > 0:
            adults = adults + adolescents
            adolescents = kids
            kids = babies
            babies = adults
            time -= 1

        overall = babies + kids + adolescents + adults
        if time2 <=0 or time2 > 100:
            print("Syötä aika välillä 1-100")
        else:
            print(overall)

def main():
    time = int(input("Anna aikasyklien määrä"))
    bacteria(time)


main()