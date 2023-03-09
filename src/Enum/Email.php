<?php

namespace App\Enum;

enum Email: string
{
    case Avd = 'ad@e-lade.lv';
    case Comp = 'lep_completed@lep.lv';
    case Auto = 'autumatika@lep-energy.lv';
    case Rm = 'remontdarbi@lep-energy.lv';
    case Tmp = 'fc@lep-energy.lv';
    case Privati = 'breksi@lep-energy.lv';
    case ZonaA = 'purvciems_zona_a@lep-energy.lv';
    case ZonaB = 'purvciems_zona_b@lep-energy.lv';
    case TaikePurv = 'purvciems_zona_c@lep-energy.lv';
    case Mezciems = 'mezciems_jugla@lep-energy.lv';
    case Jugla = 'jugla@lep-energy.lv';
    case Sarka = 'sarkandaugava_mangali@lep-energy.lv';
    case Vecmil = 'vecmilgravis_jaunciems@lep-energy.lv';
    case Tame = 'tame@lep-energy.lv';
    case NavSask = 'nav.saskanots@lep-energy.lv';
    case NavPiek = 'nav.piekluve@lep-energy.lv';
    case PapildUzd = 'papildu.uzd.ad@lep-energy.lv';
}
