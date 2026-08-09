<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StoreManager Pro - Gestion Dettes</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bg: '#070c14',
                        navbg: '#080e18',
                        navborder: '#182536',
                        statcard: '#111827',
                        statborder: '#1d2a3c',
                        sectionbg: '#111827',
                        sectionborder: '#1d2a3c',
                        searchbg: '#161e2d',
                        searchborder: '#243147',
                        thborder: '#202c3d',
                        tdborder: '#1a2535',
                        rowhover: '#151e2d',
                        btnarticlesbg: '#182232',
                        btnarticlesborder: '#243247',
                        btnpaiementsbg: '#0e2027',
                        btnpaiementsborder: '#167b80',
                        btnrembbg: '#171d27',
                        btnrembborder: '#a98200',
                        btnrembhover: '#332c09',
                        detailsborder: '#202b3c',
                        paymentsbox: '#141c2a',
                        rembbox: '#0b121d',
                        rembborder: '#1d3445',
                        rembheaderborder: '#243143',
                        restebadgebg: '#331b23',
                        restebadgeborder: '#69303a',
                        quickbtnbg: '#172130',
                        quickbtnborder: '#243247',
                        quickbtnactivebg: '#0e3c3b',
                        quickbtnactiveborder: '#1ce0c7',
                        inputbg: '#0a111b',
                        inputborder: '#1d3042',
                        msgbg: '#172131',
                        msgborder: '#26364a',
                        activeborder: '#168f8b',
                        activebg: '#092025',
                        menuhover: '#111a28',
                    },
                    fontFamily: {
                        sans: ['Arial', 'Helvetica', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        /* Uniquement ce que Tailwind ne peut pas exprimer proprement en utilitaires */
        table {
            min-width: 1000px;
        }
        .payment-table {
            min-width: auto;
        }
        .message {
            opacity: 0;
            transform: translateY(20px);
            pointer-events: none;
            transition: 0.3s;
        }
        .message.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>


<body class="font-sans bg-bg text-[#f5f7fa] min-h-screen">

<div class="container w-[98%] max-w-[1800px] mx-auto py-5">


    <!-- =========================
         NAVIGATION
    ========================= -->

    <nav class="h-[58px] border border-navborder bg-navbg rounded-[18px] flex items-center justify-between px-5 mb-5">

        <div class="flex items-center gap-2.5 text-[17px] font-bold">
            <span class="text-[18px]">📦</span>
            <span>StoreManager Pro</span>
        </div>

        <div class="flex items-center gap-2.5">

            <a href="#" class="no-underline text-[#8f9aac] text-[12px] font-semibold py-[9px] px-[14px] rounded-[9px] transition-all duration-200 hover:text-white hover:bg-menuhover">Tableau de Bord</a>

            <a href="/" class="no-underline text-[#8f9aac] text-[12px] font-semibold py-[9px] px-[14px] rounded-[9px] transition-all duration-200 hover:text-white hover:bg-menuhover">Ventes / POS</a>

            <a href="/lister/Dette" class="no-underline text-[12px] font-semibold py-[9px] px-[14px] rounded-[9px] transition-all duration-200 text-[#18d8c0] border border-activeborder bg-activebg">
                Gestion Dettes
            </a>

            <a href="#" class="no-underline text-[#8f9aac] text-[12px] font-semibold py-[9px] px-[14px] rounded-[9px] transition-all duration-200 hover:text-white hover:bg-menuhover">
                Approvisionnements
            </a>

            <a href="#" class="no-underline text-[#8f9aac] text-[12px] font-semibold py-[9px] px-[14px] rounded-[9px] transition-all duration-200 hover:text-white hover:bg-menuhover">
                Produits &amp; Tiers
            </a>

        </div>

    </nav>


    <!-- =========================
         STATISTIQUES
    ========================= -->

    <section class="grid grid-cols-1 md:grid-cols-3 gap-3.5 mb-[38px]">

        <div class="min-h-16 bg-statcard border border-statborder border-l-[3px] border-l-[#ff6268] rounded-[18px] p-3.5 flex items-center justify-between">

            <div>
                <div class="text-[#8792a5] text-[9px] font-bold uppercase mb-[5px]">
                    Créances actives
                </div>

                <div class="text-[16px] font-bold" id="totalCreances">
                    99 000 F
                </div>
            </div>

            <div class="text-[19px]">💸</div>

        </div>


        <div class="min-h-16 bg-statcard border border-statborder border-l-[3px] border-l-[#f5c400] rounded-[18px] p-3.5 flex items-center justify-between">

            <div>
                <div class="text-[#8792a5] text-[9px] font-bold uppercase mb-[5px]">
                    Clients débiteurs
                </div>

                <div class="text-[16px] font-bold" id="clientsDebiteurs">
                    3 clients
                </div>
            </div>

            <div class="text-[19px]">👥</div>

        </div>


        <div class="min-h-16 bg-statcard border border-statborder border-l-[3px] border-l-[#1dd4a7] rounded-[18px] p-3.5 flex items-center justify-between">

            <div>
                <div class="text-[#8792a5] text-[9px] font-bold uppercase mb-[5px]">
                    Total recouvrements
                </div>

                <div class="text-[16px] font-bold" id="totalRecouvrements">
                    34 000 F
                </div>
            </div>

            <div class="text-[19px]">📈</div>

        </div>

    </section>


    <!-- =========================
         DETTES
    ========================= -->

    <section class="bg-sectionbg border border-sectionborder rounded-[20px] p-[22px] overflow-hidden">


        <div class="flex items-center justify-between mb-[15px] flex-col sm:flex-row items-start sm:items-center gap-2.5">

            <h2 class="border-l-[3px] border-l-[#1bd9c2] pl-2.5 text-[13px] font-bold">
                Registre des Dettes Actives
            </h2>

            <input
                type="text"
                id="recherche"
                placeholder="Rechercher un client..."
                class="w-full sm:w-[175px] bg-searchbg border border-searchborder text-white py-[7px] px-[10px] rounded-[8px] outline-none text-[10px] focus:border-[#16c9ba]"
            >

        </div>


        <div class="w-full overflow-x-auto">

            <table class="w-full border-collapse">

                <thead>

                    <tr>

                        <th class="text-left text-[#8994a7] text-[9px] uppercase py-2.5 border-b border-thborder">ID DETTE</th>

                        <th class="text-left text-[#8994a7] text-[9px] uppercase py-2.5 border-b border-thborder">DATE CRÉATION</th>

                        <th class="text-left text-[#8994a7] text-[9px] uppercase py-2.5 border-b border-thborder">CLIENT</th>

                        <th class="text-left text-[#8994a7] text-[9px] uppercase py-2.5 border-b border-thborder">MONTANT INITIAL</th>

                        <th class="text-left text-[#8994a7] text-[9px] uppercase py-2.5 border-b border-thborder">MONTANT PAYÉ</th>

                        <th class="text-left text-[#8994a7] text-[9px] uppercase py-2.5 border-b border-thborder">RESTE DÛ</th>

                        <th class="text-left text-[#8994a7] text-[9px] uppercase py-2.5 border-b border-thborder">STATUT</th>

                        <th class="text-left text-[#8994a7] text-[9px] uppercase py-2.5 border-b border-thborder">ACTIONS</th>

                    </tr>

                </thead>


                <tbody id="listeDettes">


                    <!-- =========================================================
                         DETTE 1 — Maimouna Diallo
                    ========================================================== -->

                    <tr
                        class="dette transition-all duration-200 hover:bg-rowhover"
                        data-client="Maimouna Diallo"
                        data-dette="1"
                        data-montant="15000"
                        data-paye="0"
                    >

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">
                            <span class="font-bold text-[#aab4c5]">#DT-3</span>
                            <span class="block text-[#6f7b8f] text-[8px] mt-[3px]">#CMD-4</span>
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">
                            07 Aug 2026 23:48
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">
                            <span class="font-bold text-[#f3f5f8] client-name">Maimouna Diallo</span>
                            <span class="block text-[#7d889b] text-[8px] mt-[3px]">Tél: 701122334</span>
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle font-bold">
                            15 000 F
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle text-[#1dd4a7] font-bold montant-paye">
                            0 F
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle text-[#ff666c] font-bold montant-reste">
                            15 000 F
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle statut font-bold text-[#dce1e8]">
                            NON SOLDÉE
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">

                            <div class="flex gap-[5px]">

                                <button
                                    class="border-none cursor-pointer py-[7px] px-[10px] rounded-[7px] text-[9px] font-bold transition-all duration-200 hover:-translate-y-[1px] bg-btnarticlesbg text-white border border-btnarticlesborder"
                                    onclick="afficherArticles(this)"
                                >
                                    Articles
                                </button>

                                <button
                                    class="border-none cursor-pointer py-[7px] px-[10px] rounded-[7px] text-[9px] font-bold transition-all duration-200 hover:-translate-y-[1px] bg-btnpaiementsbg text-[#17d5c3] border border-btnpaiementsborder"
                                    onclick="afficherPaiements(this)"
                                >
                                    💳 Paiements
                                </button>

                                <button
                                    class="border-none cursor-pointer py-[7px] px-[10px] rounded-[7px] text-[9px] font-bold transition-all duration-200 hover:-translate-y-[1px] bg-btnrembbg text-[#f5c400] border border-btnrembborder hover:bg-btnrembhover"
                                    onclick="afficherRemboursement(this)"
                                >
                                    Rembourser
                                </button>

                            </div>

                        </td>

                    </tr>


                    <!-- PANNEAU PAIEMENTS — DETTE 1 (statique, masqué par défaut) -->

                    <tr class="hidden" id="paiements-1">
                        <td colspan="8" class="p-0 border-b border-detailsborder">

                            <div class="bg-paymentsbox mb-2.5 p-[15px] rounded-[14px]">

                                <div class="text-[#13d4c2] text-[10px] font-bold mb-3">
                                    Paiements enregistrés :
                                </div>

                                <table class="payment-table w-full border-collapse">

                                    <thead>
                                        <tr>
                                            <th class="text-left text-[#8994a7] text-[8px] uppercase py-2 border-b border-thborder">DATE</th>
                                            <th class="text-left text-[#8994a7] text-[8px] uppercase py-2 border-b border-thborder">VERSEMENT</th>
                                            <th class="text-left text-[#8994a7] text-[8px] uppercase py-2 border-b border-thborder">MODE</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="py-2 text-[9px] border-b border-tdborder" colspan="3">
                                                Aucun paiement enregistré pour le moment.
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>

                            </div>

                        </td>
                    </tr>


                    <!-- PANNEAU REMBOURSEMENT — DETTE 1 (statique, masqué par défaut) -->

                    <tr class="hidden" id="remb-1">
                        <td colspan="8" class="p-0 border-b border-detailsborder">

                            <div class="remboursement-box w-[675px] max-w-full bg-rembbox border border-rembborder rounded-xl p-[15px] mb-[15px] shadow-[0_15px_30px_rgba(0,0,0,0.25)]">

                                <div class="flex justify-between items-center pb-2.5 border-b border-dashed border-rembheaderborder">

                                    <div class="text-[11px] font-bold">
                                        💳 Nouveau Remboursement —
                                        <span class="text-[#15d6c1]">Maimouna Diallo</span>
                                    </div>

                                    <div id="reste-badge-1" class="bg-restebadgebg border border-restebadgeborder text-[#ff626d] text-[8px] font-bold py-[6px] px-[10px] rounded-[15px]">
                                        Reste dû : 15 000 F
                                    </div>

                                </div>


                                <div class="mt-3">

                                    <div class="text-[#8290a5] text-[8px] font-bold mb-[7px]">
                                        RACCOURCIS :
                                    </div>

                                    <div class="flex gap-[5px]">

                                        <button
                                            id="quick-total-1"
                                            class="quick-btn border-none cursor-pointer bg-quickbtnbg text-[#f0f3f6] border border-quickbtnborder rounded-md py-[5px] px-[9px] text-[8px] font-bold hover:border-[#1bcbbd]"
                                            onclick="remboursementTotal(1)"
                                        >
                                            Tout solder (15 000 F)
                                        </button>

                                        <button
                                            id="quick-moitie-1"
                                            class="quick-btn border-none cursor-pointer bg-quickbtnbg text-[#f0f3f6] border border-quickbtnborder rounded-md py-[5px] px-[9px] text-[8px] font-bold hover:border-[#1bcbbd]"
                                            onclick="remboursementMoitie(1)"
                                        >
                                            50% (7 500 F)
                                        </button>

                                    </div>

                                </div>


                                <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3 mt-3">

                                    <div class="form-group">
                                        <label class="block text-[#8995a8] text-[8px] font-bold uppercase mb-1.5">
                                            Montant du versement (FCFA)
                                        </label>
                                        <input
                                            type="number"
                                            id="montant-remb-1"
                                            class="w-full h-[34px] bg-inputbg border border-inputborder rounded-lg text-white px-[10px] outline-none text-[10px] focus:border-[#17cbbd]"
                                            value="15000"
                                            min="1"
                                            max="15000"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label class="block text-[#8995a8] text-[8px] font-bold uppercase mb-1.5">
                                            Canal de paiement
                                        </label>
                                        <select class="w-full h-[34px] bg-inputbg border border-inputborder rounded-lg text-white px-[10px] outline-none text-[10px] focus:border-[#17cbbd]">
                                            <option>🟠 Orange Money</option>
                                            <option>🔵 Wave</option>
                                            <option>🟢 Free Money</option>
                                            <option>💵 Espèces</option>
                                        </select>
                                    </div>

                                    <button
                                        class="h-[34px] self-end border-none rounded-lg bg-[#17c997] hover:bg-[#14b789] text-white px-[17px] text-[9px] font-bold cursor-pointer w-full sm:w-auto"
                                        onclick="enregistrerRemboursement(1)"
                                    >
                                        ✓ ENREGISTRER LE REMBOURSEMENT
                                    </button>

                                </div>

                            </div>

                        </td>
                    </tr>


                    <!-- =========================================================
                         DETTE 2 — Moussa Sarr
                    ========================================================== -->

                    <tr
                        class="dette transition-all duration-200 hover:bg-rowhover"
                        data-client="Moussa Sarr"
                        data-dette="2"
                        data-montant="74000"
                        data-paye="24000"
                    >

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">
                            <span class="font-bold text-[#aab4c5]">#DT-2</span>
                            <span class="block text-[#6f7b8f] text-[8px] mt-[3px]">#CMD-3</span>
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">
                            07 Aug 2026 22:48
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">
                            <span class="font-bold text-[#f3f5f8] client-name">Moussa Sarr</span>
                            <span class="block text-[#7d889b] text-[8px] mt-[3px]">Tél: 769876543</span>
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle font-bold">
                            74 000 F
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle text-[#1dd4a7] font-bold montant-paye">
                            24 000 F
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle text-[#ff666c] font-bold montant-reste">
                            50 000 F
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle statut font-bold text-[#dce1e8]">
                            NON SOLDÉE
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">

                            <div class="flex gap-[5px]">

                                <button
                                    class="border-none cursor-pointer py-[7px] px-[10px] rounded-[7px] text-[9px] font-bold transition-all duration-200 hover:-translate-y-[1px] bg-btnarticlesbg text-white border border-btnarticlesborder"
                                    onclick="afficherArticles(this)"
                                >
                                    Articles
                                </button>

                                <button
                                    class="border-none cursor-pointer py-[7px] px-[10px] rounded-[7px] text-[9px] font-bold transition-all duration-200 hover:-translate-y-[1px] bg-btnpaiementsbg text-[#17d5c3] border border-btnpaiementsborder"
                                    onclick="afficherPaiements(this)"
                                >
                                    💳 Paiements
                                </button>

                                <button
                                    class="border-none cursor-pointer py-[7px] px-[10px] rounded-[7px] text-[9px] font-bold transition-all duration-200 hover:-translate-y-[1px] bg-btnrembbg text-[#f5c400] border border-btnrembborder hover:bg-btnrembhover"
                                    onclick="afficherRemboursement(this)"
                                >
                                    Rembourser
                                </button>

                            </div>

                        </td>

                    </tr>


                    <!-- PANNEAU PAIEMENTS — DETTE 2 (statique, masqué par défaut) -->

                    <tr class="hidden" id="paiements-2">
                        <td colspan="8" class="p-0 border-b border-detailsborder">

                            <div class="bg-paymentsbox mb-2.5 p-[15px] rounded-[14px]">

                                <div class="text-[#13d4c2] text-[10px] font-bold mb-3">
                                    Paiements enregistrés :
                                </div>

                                <table class="payment-table w-full border-collapse">

                                    <thead>
                                        <tr>
                                            <th class="text-left text-[#8994a7] text-[8px] uppercase py-2 border-b border-thborder">DATE</th>
                                            <th class="text-left text-[#8994a7] text-[8px] uppercase py-2 border-b border-thborder">VERSEMENT</th>
                                            <th class="text-left text-[#8994a7] text-[8px] uppercase py-2 border-b border-thborder">MODE</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="py-2 text-[9px] border-b border-tdborder">2026-08-07 22:48:53</td>
                                            <td class="py-2 text-[9px] border-b border-tdborder text-[#1dd4a7] font-bold">24 000 F</td>
                                            <td class="py-2 text-[9px] border-b border-tdborder">Wave</td>
                                        </tr>
                                    </tbody>

                                </table>

                            </div>

                        </td>
                    </tr>


                    <!-- PANNEAU REMBOURSEMENT — DETTE 2 (statique, masqué par défaut) -->

                    <tr class="hidden" id="remb-2">
                        <td colspan="8" class="p-0 border-b border-detailsborder">

                            <div class="remboursement-box w-[675px] max-w-full bg-rembbox border border-rembborder rounded-xl p-[15px] mb-[15px] shadow-[0_15px_30px_rgba(0,0,0,0.25)]">

                                <div class="flex justify-between items-center pb-2.5 border-b border-dashed border-rembheaderborder">

                                    <div class="text-[11px] font-bold">
                                        💳 Nouveau Remboursement —
                                        <span class="text-[#15d6c1]">Moussa Sarr</span>
                                    </div>

                                    <div id="reste-badge-2" class="bg-restebadgebg border border-restebadgeborder text-[#ff626d] text-[8px] font-bold py-[6px] px-[10px] rounded-[15px]">
                                        Reste dû : 50 000 F
                                    </div>

                                </div>


                                <div class="mt-3">

                                    <div class="text-[#8290a5] text-[8px] font-bold mb-[7px]">
                                        RACCOURCIS :
                                    </div>

                                    <div class="flex gap-[5px]">

                                        <button
                                            id="quick-total-2"
                                            class="quick-btn border-none cursor-pointer bg-quickbtnbg text-[#f0f3f6] border border-quickbtnborder rounded-md py-[5px] px-[9px] text-[8px] font-bold hover:border-[#1bcbbd]"
                                            onclick="remboursementTotal(2)"
                                        >
                                            Tout solder (50 000 F)
                                        </button>

                                        <button
                                            id="quick-moitie-2"
                                            class="quick-btn border-none cursor-pointer bg-quickbtnbg text-[#f0f3f6] border border-quickbtnborder rounded-md py-[5px] px-[9px] text-[8px] font-bold hover:border-[#1bcbbd]"
                                            onclick="remboursementMoitie(2)"
                                        >
                                            50% (25 000 F)
                                        </button>

                                    </div>

                                </div>


                                <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3 mt-3">

                                    <div class="form-group">
                                        <label class="block text-[#8995a8] text-[8px] font-bold uppercase mb-1.5">
                                            Montant du versement (FCFA)
                                        </label>
                                        <input
                                            type="number"
                                            id="montant-remb-2"
                                            class="w-full h-[34px] bg-inputbg border border-inputborder rounded-lg text-white px-[10px] outline-none text-[10px] focus:border-[#17cbbd]"
                                            value="50000"
                                            min="1"
                                            max="50000"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label class="block text-[#8995a8] text-[8px] font-bold uppercase mb-1.5">
                                            Canal de paiement
                                        </label>
                                        <select class="w-full h-[34px] bg-inputbg border border-inputborder rounded-lg text-white px-[10px] outline-none text-[10px] focus:border-[#17cbbd]">
                                            <option>🟠 Orange Money</option>
                                            <option>🔵 Wave</option>
                                            <option>🟢 Free Money</option>
                                            <option>💵 Espèces</option>
                                        </select>
                                    </div>

                                    <button
                                        class="h-[34px] self-end border-none rounded-lg bg-[#17c997] hover:bg-[#14b789] text-white px-[17px] text-[9px] font-bold cursor-pointer w-full sm:w-auto"
                                        onclick="enregistrerRemboursement(2)"
                                    >
                                        ✓ ENREGISTRER LE REMBOURSEMENT
                                    </button>

                                </div>

                            </div>

                        </td>
                    </tr>


                    <!-- =========================================================
                         DETTE 3 — Fama Diouf
                    ========================================================== -->

                    <tr
                        class="dette transition-all duration-200 hover:bg-rowhover"
                        data-client="Fama Diouf"
                        data-dette="3"
                        data-montant="44000"
                        data-paye="10000"
                    >

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">
                            <span class="font-bold text-[#aab4c5]">#DT-1</span>
                            <span class="block text-[#6f7b8f] text-[8px] mt-[3px]">#CMD-2</span>
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">
                            07 Aug 2026 21:48
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">
                            <span class="font-bold text-[#f3f5f8] client-name">Fama Diouf</span>
                            <span class="block text-[#7d889b] text-[8px] mt-[3px]">Tél: 781234567</span>
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle font-bold">
                            44 000 F
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle text-[#1dd4a7] font-bold montant-paye">
                            10 000 F
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle text-[#ff666c] font-bold montant-reste">
                            34 000 F
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle statut font-bold text-[#dce1e8]">
                            NON SOLDÉE
                        </td>

                        <td class="py-[11px] text-[10px] border-b border-tdborder align-middle">

                            <div class="flex gap-[5px]">

                                <button
                                    class="border-none cursor-pointer py-[7px] px-[10px] rounded-[7px] text-[9px] font-bold transition-all duration-200 hover:-translate-y-[1px] bg-btnarticlesbg text-white border border-btnarticlesborder"
                                    onclick="afficherArticles(this)"
                                >
                                    Articles
                                </button>

                                <button
                                    class="border-none cursor-pointer py-[7px] px-[10px] rounded-[7px] text-[9px] font-bold transition-all duration-200 hover:-translate-y-[1px] bg-btnpaiementsbg text-[#17d5c3] border border-btnpaiementsborder"
                                    onclick="afficherPaiements(this)"
                                >
                                    💳 Paiements
                                </button>

                                <button
                                    class="border-none cursor-pointer py-[7px] px-[10px] rounded-[7px] text-[9px] font-bold transition-all duration-200 hover:-translate-y-[1px] bg-btnrembbg text-[#f5c400] border border-btnrembborder hover:bg-btnrembhover"
                                    onclick="afficherRemboursement(this)"
                                >
                                    Rembourser
                                </button>

                            </div>

                        </td>

                    </tr>


                    <!-- PANNEAU PAIEMENTS — DETTE 3 (statique, masqué par défaut) -->

                    <tr class="hidden" id="paiements-3">
                        <td colspan="8" class="p-0 border-b border-detailsborder">

                            <div class="bg-paymentsbox mb-2.5 p-[15px] rounded-[14px]">

                                <div class="text-[#13d4c2] text-[10px] font-bold mb-3">
                                    Paiements enregistrés :
                                </div>

                                <table class="payment-table w-full border-collapse">

                                    <thead>
                                        <tr>
                                            <th class="text-left text-[#8994a7] text-[8px] uppercase py-2 border-b border-thborder">DATE</th>
                                            <th class="text-left text-[#8994a7] text-[8px] uppercase py-2 border-b border-thborder">VERSEMENT</th>
                                            <th class="text-left text-[#8994a7] text-[8px] uppercase py-2 border-b border-thborder">MODE</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="py-2 text-[9px] border-b border-tdborder">2026-08-07 21:48:12</td>
                                            <td class="py-2 text-[9px] border-b border-tdborder text-[#1dd4a7] font-bold">10 000 F</td>
                                            <td class="py-2 text-[9px] border-b border-tdborder">Orange Money</td>
                                        </tr>
                                    </tbody>

                                </table>

                            </div>

                        </td>
                    </tr>


                    <!-- PANNEAU REMBOURSEMENT — DETTE 3 (statique, masqué par défaut) -->

                    <tr class="hidden" id="remb-3">
                        <td colspan="8" class="p-0 border-b border-detailsborder">

                            <div class="remboursement-box w-[675px] max-w-full bg-rembbox border border-rembborder rounded-xl p-[15px] mb-[15px] shadow-[0_15px_30px_rgba(0,0,0,0.25)]">

                                <div class="flex justify-between items-center pb-2.5 border-b border-dashed border-rembheaderborder">

                                    <div class="text-[11px] font-bold">
                                        💳 Nouveau Remboursement —
                                        <span class="text-[#15d6c1]">Fama Diouf</span>
                                    </div>

                                    <div id="reste-badge-3" class="bg-restebadgebg border border-restebadgeborder text-[#ff626d] text-[8px] font-bold py-[6px] px-[10px] rounded-[15px]">
                                        Reste dû : 34 000 F
                                    </div>

                                </div>


                                <div class="mt-3">

                                    <div class="text-[#8290a5] text-[8px] font-bold mb-[7px]">
                                        RACCOURCIS :
                                    </div>

                                    <div class="flex gap-[5px]">

                                        <button
                                            id="quick-total-3"
                                            class="quick-btn border-none cursor-pointer bg-quickbtnbg text-[#f0f3f6] border border-quickbtnborder rounded-md py-[5px] px-[9px] text-[8px] font-bold hover:border-[#1bcbbd]"
                                            onclick="remboursementTotal(3)"
                                        >
                                            Tout solder (34 000 F)
                                        </button>

                                        <button
                                            id="quick-moitie-3"
                                            class="quick-btn border-none cursor-pointer bg-quickbtnbg text-[#f0f3f6] border border-quickbtnborder rounded-md py-[5px] px-[9px] text-[8px] font-bold hover:border-[#1bcbbd]"
                                            onclick="remboursementMoitie(3)"
                                        >
                                            50% (17 000 F)
                                        </button>

                                    </div>

                                </div>


                                <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3 mt-3">

                                    <div class="form-group">
                                        <label class="block text-[#8995a8] text-[8px] font-bold uppercase mb-1.5">
                                            Montant du versement (FCFA)
                                        </label>
                                        <input
                                            type="number"
                                            id="montant-remb-3"
                                            class="w-full h-[34px] bg-inputbg border border-inputborder rounded-lg text-white px-[10px] outline-none text-[10px] focus:border-[#17cbbd]"
                                            value="34000"
                                            min="1"
                                            max="34000"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <label class="block text-[#8995a8] text-[8px] font-bold uppercase mb-1.5">
                                            Canal de paiement
                                        </label>
                                        <select class="w-full h-[34px] bg-inputbg border border-inputborder rounded-lg text-white px-[10px] outline-none text-[10px] focus:border-[#17cbbd]">
                                            <option>🟠 Orange Money</option>
                                            <option>🔵 Wave</option>
                                            <option>🟢 Free Money</option>
                                            <option>💵 Espèces</option>
                                        </select>
                                    </div>

                                    <button
                                        class="h-[34px] self-end border-none rounded-lg bg-[#17c997] hover:bg-[#14b789] text-white px-[17px] text-[9px] font-bold cursor-pointer w-full sm:w-auto"
                                        onclick="enregistrerRemboursement(3)"
                                    >
                                        ✓ ENREGISTRER LE REMBOURSEMENT
                                    </button>

                                </div>

                            </div>

                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </section>

</div>


<!-- =========================
     MESSAGE
========================= -->

<div id="message" class="message fixed right-5 bottom-5 bg-msgbg border border-msgborder py-3 px-[18px] rounded-[10px] text-white text-[11px] z-[1000]">
    Remboursement enregistré avec succès.
</div>


<script>

    /* ==================================================
       FORMATAGE DES NOMBRES
    ================================================== */

    function formaterMontant(nombre) {

        return new Intl.NumberFormat('fr-FR').format(nombre) + " F";

    }


    /* ==================================================
       AFFICHER MESSAGE
    ================================================== */

    function afficherMessage(texte) {

        const message = document.getElementById("message");

        message.textContent = texte;

        message.classList.add("show");

        setTimeout(function () {

            message.classList.remove("show");

        }, 2500);

    }


    /* ==================================================
       ARTICLES
    ================================================== */

    function afficherArticles(bouton) {

        const ligne = bouton.closest(".dette");

        const client =
            ligne.querySelector(".client-name").textContent.trim();

        afficherMessage(
            "Articles de " + client
        );

    }


    /* ==================================================
       PAIEMENTS (le panneau existe déjà dans le HTML,
       on se contente de l'afficher / le masquer)
    ================================================== */

    function afficherPaiements(bouton) {

        const ligne = bouton.closest(".dette");

        const id = ligne.getAttribute("data-dette");

        document
            .getElementById("paiements-" + id)
            .classList.toggle("hidden");

    }


    /* ==================================================
       REMBOURSEMENT (le panneau existe déjà dans le HTML,
       on se contente de l'afficher / le masquer)
    ================================================== */

    function afficherRemboursement(bouton) {

        const ligne = bouton.closest(".dette");

        const id = ligne.getAttribute("data-dette");

        document
            .getElementById("remb-" + id)
            .classList.toggle("hidden");

    }


    /* ==================================================
       CALCULER LE RESTE DÛ ACTUEL D'UNE DETTE
    ================================================== */

    function calculerResteDette(id) {

        const ligne =
            document.querySelector(
                '.dette[data-dette="' + id + '"]'
            );

        return (
            parseInt(ligne.getAttribute("data-montant")) -
            parseInt(ligne.getAttribute("data-paye"))
        );

    }


    /* ==================================================
       TOUT SOLDER
    ================================================== */

    function remboursementTotal(id) {

        const reste = calculerResteDette(id);

        document.getElementById(
            "montant-remb-" + id
        ).value = reste;

    }


    /* ==================================================
       50 %
    ================================================== */

    function remboursementMoitie(id) {

        const reste = calculerResteDette(id);

        document.getElementById(
            "montant-remb-" + id
        ).value = Math.floor(reste / 2);

    }


    /* ==================================================
       ENREGISTRER REMBOURSEMENT
    ================================================== */

    function enregistrerRemboursement(id) {

        const ligne =
            document.querySelector(
                '.dette[data-dette="' + id + '"]'
            );

        const input =
            document.getElementById(
                "montant-remb-" + id
            );

        const montant =
            parseInt(input.value);

        const resteActuel =
            calculerResteDette(id);


        /* Vérification */

        if (
            isNaN(montant) ||
            montant <= 0
        ) {

            afficherMessage(
                "Veuillez saisir un montant valide."
            );

            return;
        }


        if (montant > resteActuel) {

            afficherMessage(
                "Le montant dépasse le reste dû."
            );

            return;
        }


        /* Anciennes valeurs */

        let ancienPaye =
            parseInt(
                ligne.getAttribute("data-paye")
            );

        let montantInitial =
            parseInt(
                ligne.getAttribute("data-montant")
            );


        /* Calcul */

        let nouveauPaye =
            ancienPaye + montant;

        let nouveauReste =
            montantInitial - nouveauPaye;


        /* Mise à jour de la ligne dans le tableau */

        ligne.setAttribute(
            "data-paye",
            nouveauPaye
        );


        ligne.querySelector(
            ".montant-paye"
        ).textContent =
            formaterMontant(nouveauPaye);


        ligne.querySelector(
            ".montant-reste"
        ).textContent =
            formaterMontant(nouveauReste);


        /* Mise à jour statut */

        const statut =
            ligne.querySelector(".statut");


        if (nouveauReste === 0) {

            statut.textContent =
                "SOLDÉE";

            statut.classList.add("text-[#1dd4a7]");

        } else {

            statut.textContent =
                "NON SOLDÉE";

        }


        /* Mise à jour du panneau de remboursement
           (badge, raccourcis, champ) pour la prochaine ouverture */

        document.getElementById(
            "reste-badge-" + id
        ).textContent =
            "Reste dû : " + formaterMontant(nouveauReste);

        document.getElementById(
            "quick-total-" + id
        ).textContent =
            "Tout solder (" + formaterMontant(nouveauReste) + ")";

        document.getElementById(
            "quick-moitie-" + id
        ).textContent =
            "50% (" + formaterMontant(Math.floor(nouveauReste / 2)) + ")";

        input.value = nouveauReste;
        input.max = nouveauReste;


        /* Masquer le panneau */

        document.getElementById(
            "remb-" + id
        ).classList.add("hidden");


        /* Actualiser statistiques */

        actualiserStatistiques();


        /* Message */

        afficherMessage(
            "Remboursement de " +
            formaterMontant(montant) +
            " enregistré."
        );

    }


    /* ==================================================
       ACTUALISER STATISTIQUES
    ================================================== */

    function actualiserStatistiques() {

        const dettes =
            document.querySelectorAll(".dette");


        let totalRestant = 0;

        let totalPaye = 0;

        let nombreDebiteurs = 0;


        dettes.forEach(function (dette) {

            const montant =
                parseInt(
                    dette.getAttribute("data-montant")
                );

            const paye =
                parseInt(
                    dette.getAttribute("data-paye")
                );


            const reste =
                montant - paye;


            totalRestant += reste;

            totalPaye += paye;


            if (reste > 0) {

                nombreDebiteurs++;

            }

        });


        document.getElementById(
            "totalCreances"
        ).textContent =
            formaterMontant(totalRestant);


        document.getElementById(
            "clientsDebiteurs"
        ).textContent =
            nombreDebiteurs + " client" +
            (nombreDebiteurs > 1 ? "s" : "");


        document.getElementById(
            "totalRecouvrements"
        ).textContent =
            formaterMontant(totalPaye);

    }


    /* ==================================================
       RECHERCHE CLIENT
    ================================================== */

    document
        .getElementById("recherche")
        .addEventListener(
            "input",
            function () {

                const recherche =
                    this.value.toLowerCase();


                const dettes =
                    document.querySelectorAll(
                        ".dette"
                    );


                dettes.forEach(function (dette) {

                    const client =
                        dette
                        .getAttribute("data-client")
                        .toLowerCase();


                    if (
                        client.includes(recherche)
                    ) {

                        dette.style.display = "";

                    } else {

                        dette.style.display = "none";

                    }

                });

            }
        );


</script>

</body>
</html>