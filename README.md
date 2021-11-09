# Mini-pi-NVR

Raspberry Pi NVR app. (OS: Debian, HW: Rpi 3b+)
Linux NVR app.
Fejlesztői os: Debian Linux

A program Raspberry Pi-hez készült, de bármely Linux-on működik.

Rendszersükséglet:
- Webszerver, php támogatással
- `motion` program beállítva
- `cron` szolgáltatás

# NVR

Fejlesztő: [pphome2](https:/github.com/pphome2)

**Aktuális verzió: 2021.**

Raspberry Pi használata biztonsági kamera rögzítőnek. Ehhez a Linux alaprendzser
`motion` programját használjuk, ami rögzíti a mozgásokat. Ez a program web-es felületet
biztosítít a rögzített fájlok kezeléséhez.

A rögzítés ki- és bekapcsolásához, valamint az időzítésekhez egy időszakos ellenőrző 
script-et használhatunk, amit `cron`-ból futtatunk. A rögzített fájlok naponkénti 
tárolását egy `cron`-ból futtatott script végzi. A program három előző napot tárol.

# Funkciók

## Napi videók tárolása

A `cron`-ból futó szolgáltatás éjfélkor három korábbi nap videóit tárolja, a régebbieket törli.
A `Szolgáltatások` menüpontban törölhető az aznapi vagy korábbi napok tárolt fájljai

A megjelenített nap videóit táblázatban mutatja, ahol a fájlnév alapján szűrni lehet az egyes
kamerák videóit. Rákattintva lejátszható, törölhető vagy atrtósan tárolható a videó.

A táblázatból közvetlenül letölthető vagy törölhető a videó.

## Szolgáltatások

A menüpontban indítható vagy leállítható a rögzítés. A `cron`-ból futó szolgáltatás figyeli a 
változást 5 percente, a kérés alapján elindítja vagy leállítja a rögzítő programot. (`motion`)

Innen törölhető az összes aznapon vagy korábbi napokon rögzített videó. Ez nem érinti a tartós
tásolóba tett fájlokat.

Időzítő funkcióval beállítható napokra bontva a rögzítés indítása és leállítása. Beállítható
az éjszakai rögzítés is, ami a beállítás fájlban szabályozható időintervallumot használ.
(`config/config.php`)

## Tartós tároló

Az ide helyezett fájlok egyesével lejátszhatók, letölthetők vagy törölhetők. Innen csak
egyessével törölhetők a fájlok.

## Élőkép

A `motion` program által feldolgozott videó strem-eket jeleníti meg és nagyítja a kiválasztott
stream-et.
