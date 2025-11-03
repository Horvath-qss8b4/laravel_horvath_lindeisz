import os

# A futó .py fájl mappájának elérési útja
konyvtar = os.path.dirname(os.path.abspath(__file__))

print(f"Könyvtár: {konyvtar}\n")

# Kilistázza a mappa összes elemét (fájlokat és almappákat)
for elem in os.listdir(konyvtar):
    teljes_ut = os.path.join(konyvtar, elem)
    if os.path.isdir(teljes_ut):
        print(f"{elem}")
    else:
        print(f"      {elem}")
