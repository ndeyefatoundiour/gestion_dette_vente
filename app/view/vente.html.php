
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>StoreManager Pro - Ventes</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  body { font-family: Arial, Helvetica, sans-serif; }
</style>
</head>
<body class="min-h-screen bg-[#080d17] text-[#f1f5f9] px-4 py-6">

<div class="max-w-[1800px] mx-auto">

  <!-- NAVIGATION -->
  <nav class="h-14 bg-[#0b111d] border border-[#172338] rounded-[18px] flex items-center justify-between px-5 mb-5 flex-wrap gap-3">
    <div class="text-[17px] font-bold text-[#f8fafc] flex items-center">
      <span class="mr-2">📦</span> StoreManager Pro
    </div>
    <div class="flex items-center gap-2 flex-wrap">
      <a href="#" class="text-[11px] font-bold px-3.5 py-2 rounded-[10px] text-[#8d99aa] hover:text-white hover:bg-[#111c2d] transition">Tableau de Bord</a>
      <a href="/" class="text-[11px] font-bold px-3.5 py-2 rounded-[10px] text-[#19d3c5] border border-[#087f80] bg-[#0c2028]">Ventes / POS</a>
      <a href="/lister/Dette" class="text-[11px] font-bold px-3.5 py-2 rounded-[10px] text-[#8d99aa] hover:text-white hover:bg-[#111c2d] transition">Gestion Dettes</a>
      <a href="#" class="text-[11px] font-bold px-3.5 py-2 rounded-[10px] text-[#8d99aa] hover:text-white hover:bg-[#111c2d] transition">Approvisionnements</a>
      <a href="#" class="text-[11px] font-bold px-3.5 py-2 rounded-[10px] text-[#8d99aa] hover:text-white hover:bg-[#111c2d] transition">Produits & Tiers</a>
    </div>
  </nav>

  <!-- STATISTIQUES -->
  <section class="grid grid-cols-1 md:grid-cols-3 gap-3.5 mb-10">
    <div class="h-16 bg-[#111827] border border-[#1b2a40] border-l-[3px] border-l-[#22d3a5] rounded-[18px] flex items-center justify-between px-4">
      <div>
        <div class="text-[9px] font-bold uppercase text-[#8995a7] mb-1">CA Encaissé Net</div>
        <div class="text-[16px] font-bold"><?php echo $totalRecue['total_recue']?>F</div>
      </div>
      <div class="text-[20px]">💰</div>
    </div>
    <div class="h-16 bg-[#111827] border border-[#1b2a40] border-l-[3px] border-l-[#ff6666] rounded-[18px] flex items-center justify-between px-4">
      <div>
        <div class="text-[9px] font-bold uppercase text-[#8995a7] mb-1">En Cours Client Total</div>
        <div class="text-[16px] font-bold"><?php echo $totalDue['créances_actives']?> F</div>
      </div>
      <div class="text-[20px]">🛑</div>
    </div>
    <div class="h-16 bg-[#111827] border border-[#1b2a40] border-l-[3px] border-l-[#22d3a5] rounded-[18px] flex items-center justify-between px-4">
      <div>
        <div class="text-[9px] font-bold uppercase text-[#8995a7] mb-1">Commandes Enregistrées</div>
        <div class="text-[16px] font-bold"><?php echo $numbVente['nombr_vente']?></div>
      </div>
      <div class="text-[20px]">📊</div>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <main class="grid grid-cols-1 xl:grid-cols-[475px_1fr] gap-6 items-start">

    <!-- NOUVELLE VENTE -->
    <section class="bg-[#101827] border border-[#1b2a40] rounded-[20px] p-4">

      <div class="flex items-center gap-2 text-[13px] font-bold mb-5">
        <span class="w-[3px] h-[18px] bg-[#1dd3c5] rounded"></span>
        🛒 Nouvelle Vente
        <span class="ml-auto text-[9px] text-[#8c98aa] bg-[#182235] px-2 py-1 rounded-md">Terminal POS</span>
      </div>

      <!-- CLIENT -->
      <div class="mb-4">
        <label class="block text-[9px] font-bold uppercase text-[#8f9bae] mb-1.5">Client Acheteur</label>
        <select class="w-full h-9 bg-[#090f1a] text-[#e5e7eb] border border-[#1b2a3d] rounded-[9px] px-2.5 text-[11px] outline-none focus:border-[#17bcb4]">
            <?php $clients=$clients??[];

          foreach ($clients as $key => $clients) :?>
          <option><?php echo $clients['info_client']?></option>
           <?php endforeach ?>
        </select>
      </div>

      <div class="border-t border-dashed border-[#1b293c] my-5"></div>

      <!-- ARTICLES -->
      <div class="text-[#1bd4c4] text-[10px] font-bold uppercase mb-2.5">Sélection des articles</div>

      <div class="grid grid-cols-[1fr_80px_34px] gap-1.5 items-end">
        <div>
          <label class="block text-[9px] font-bold uppercase text-[#8f9bae] mb-1.5">Article</label>
          <select class="w-full h-9 bg-[#090f1a] text-[#e5e7eb] border border-[#1b2a3d] rounded-[9px] px-2.5 text-[11px] outline-none focus:border-[#17bcb4]">
               <?php $produit=$produit??[];

          foreach ($produit as $key => $produit) :?>
          <option><?php echo $produit['libelle']?>/option>
           <?php endforeach ?>
          </select>
        </div>
        <div>
          <label class="block text-[9px] font-bold uppercase text-[#8f9bae] mb-1.5">Qté</label>
          <input type="number" value="1" min="1" class="w-full h-9 bg-[#090f1a] text-[#e5e7eb] border border-[#1b2a3d] rounded-[9px] px-2.5 text-[11px] outline-none focus:border-[#17bcb4]">
        </div>
        <button type="button" class="h-[34px] w-[34px] rounded-[7px] bg-[#15c5b7] text-[#06231f] text-[20px] font-bold hover:bg-[#22dfcf] hover:scale-105 transition">+</button>
      </div>

      <!-- PANIER -->
      <div class="mt-3.5">
        <div class="grid grid-cols-[1fr_60px_90px_25px] border-b border-[#1b293c] pb-2 text-[8px] font-bold uppercase text-[#8290a4]">
          <span>Produit</span>
          <span>Qté</span>
          <span>Total</span>
          <span></span>
        </div>
        <div class="h-[55px] flex items-center justify-center text-[#7e8a9c] text-[10px]">
          Panier vide. Ajoutez des articles.
        </div>
      </div>

      <!-- TOTAL -->
      <div class="mt-2.5 min-h-[58px] rounded-[13px] bg-[#17263d] flex flex-col justify-center items-center p-2">
        <div class="text-[8px] font-bold uppercase text-[#8c98aa] mb-1">Montant total net à payer</div>
        <div class="text-[#62a9ff] text-[18px] font-bold">0 <small>FCFA</small></div>
      </div>

      <!-- PAIEMENT -->
      <div class="grid grid-cols-2 gap-3.5 mt-4.5">
        <div>
          <label class="block text-[9px] font-bold uppercase text-[#8f9bae] mb-1.5">Règlement</label>
          <select class="w-full h-9 bg-[#090f1a] text-[#e5e7eb] border border-[#1b2a3d] rounded-[9px] px-2.5 text-[11px] outline-none focus:border-[#17bcb4]">
            <?php foreach ($getModePay as $getModePay) :?>
          <option><?php echo $getModePay['nom']?></option>
           <?php endforeach ?>
          </select>
        </div>
        <div>
          <label class="block text-[9px] font-bold uppercase text-[#8f9bae] mb-1.5">Versé (Avance)</label>
          <input type="number" value="0" min="0" class="w-full h-9 bg-[#090f1a] text-[#e5e7eb] border border-[#1b2a3d] rounded-[9px] px-2.5 text-[11px] outline-none focus:border-[#17bcb4]">
        </div>
      </div>

      <!-- RESTANT -->
      <div class="mt-2.5 bg-[#0d1726] border border-[#1b2b40] rounded-lg p-1.5 text-[9px] text-[#8995a7]">
        Reste à payer : <span class="text-[#ffbd5a] font-bold ml-1">0 FCFA</span>
      </div>

      <!-- VALIDATION -->
      <button type="button" class="w-full h-9 mt-4.5 rounded-[9px] text-white text-[10px] font-bold bg-gradient-to-r from-[#2dd39c] to-[#09a978] hover:brightness-110 hover:-translate-y-px transition">
        VALIDER LA VENTE (DML)
      </button>

    </section>

    <!-- REGISTRE DES VENTES -->
    <section class="bg-[#101827] border border-[#1b2a40] rounded-[20px] px-5 py-5">

      <div class="flex items-center gap-2 text-[13px] font-bold mb-5">
        <span class="w-[3px] h-[18px] bg-[#1dd3c5] rounded"></span>
        Registre Général des Ventes & Commandes
      </div>

      <table class="w-full border-collapse">
        <thead>
          <tr class="border-b border-[#1d2a3c] text-[8px] font-bold uppercase text-[#8290a4]">
            <th class="text-left pb-2.5">ID</th>
            <th class="text-left pb-2.5">Client</th>
            <th class="text-left pb-2.5">Total Facture</th>
            <th class="text-left pb-2.5 hidden sm:table-cell">Règlement</th>
            <th class="text-left pb-2.5">Actions</th>
          </tr>
        </thead>
        <tbody class="text-[10px]">

          <?php $allVente=$allVente??[];

          foreach ($allVente as $key => $allVente) :?>

          <tr class="border-b border-[#192538] h-14">
            <td class="font-bold text-[#9aa6b8]"><?php echo $allVente['ide']?></td>
            <td>
              <div class="font-bold text-[#e8edf4]"><?php echo $allVente['nomcomplet']?></div>
              <div class="text-[8px] text-[#7e8b9e]">Tél : <?php echo $allVente['telephone']?></div>
            </td>
            <td class="text-[#13d1c0] font-bold"><?php echo $allVente['total']?></td>
            <td class="text-[9px] font-bold text-[#d7dde7] hidden sm:table-cell"><?php echo $allVente['nom']?></td>
            <td>
              <button type="button" onclick="toggleDetail('detail<?php echo $key ?>')" class="border border-[#25344a] bg-[#141e2e] text-[#d9e0e9] px-2.5 py-1.5 rounded-[7px] text-[8px] hover:border-[#1bbdb4] hover:text-[#1bbdb4] transition">Lignes</button>
            </td>
          </tr>
          <tr id="detail<?php echo $key ?>" class="hidden">
            <td colspan="5" class="pb-4">
              <div class="bg-[#121d2d] border border-[#1d2b40] rounded-[13px] p-3.5">
                <div class="text-[#17cfc0] text-[10px] font-bold mb-2.5">Détails Facture :</div>
                <table class="w-full border-collapse">
                  <thead>
                    <tr class="border-b border-[#1c2a3c] text-[8px] uppercase text-[#8491a5]">
                      <th class="text-left pb-2">Produit</th>
                      <th class="text-left pb-2">Qté</th>
                      <th class="text-left pb-2">P.U.</th>
                      <th class="text-left pb-2">Sous-total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($allVente['leprod'] as $key => $leprod) :?>
                    <tr class="text-[10px]">
                      <td class="py-2.5"><?php echo $leprod['libelle']?></td>
                      <td class="py-2.5"><?php echo $leprod['qt_vente']?><td>
                      <td class="py-2.5"><?php echo $leprod['prix_unitaire']?> F</td>
                      <td class="py-2.5 text-[#16d2c1] font-bold"><?php echo $leprod['prix_vendu']?>F</td>
                    </tr>
                    <<?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
            <?php  endforeach ?>
        </tbody>
      </table>

    </section>

  </main>

</div>

<script>
  // Seule fonction JS conservée : afficher/cacher les lignes de détail d'une facture
  function toggleDetail(id) {
    
    document.getElementById(id).classList.toggle('hidden');
  }
</script>

</body>
</html>