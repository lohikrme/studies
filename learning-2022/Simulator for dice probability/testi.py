import random

# Arvotaan haluttu määrä noppia, palautetaan suurimman nopan arvo
def arvo_nopat(maara: int):
    tulos = []
    for i in range(maara):
        tulos.append(random.randint(1,6))
    return max(tulos)

a_voittaa = 0
b_voittaa = 0
tasapeli = 0

for i in range(100000):
    a = arvo_nopat(6)
    b = arvo_nopat(15)
    if b > a:
        b_voittaa +=1
    elif b == a:
        tasapeli += 1
    else:
        a_voittaa += 1

yhteensa = a_voittaa + b_voittaa + tasapeli
print(f'A voitti {a_voittaa / yhteensa *100} %')
print(f'B voitti {b_voittaa /yhteensa*100} %')
print(f'tasapelejä {tasapeli / yhteensa*100} %')

print(f'kierroksia yhteensä {a_voittaa + b_voittaa + tasapeli}')