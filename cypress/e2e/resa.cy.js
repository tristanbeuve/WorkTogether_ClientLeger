describe('Template Spec', () => {
  beforeEach(() => {
    // Se connecter avant chaque test
    cy.login('Quincy17@Daniel.com', '123456789');
  });

  it('Affiche le message d\'erreur en cas de compte invalide', () => {
    // Visiter la page
    cy.visit('/reserver');
    cy.get('#reservation_IdentifiantAbonnement').select('1')
    cy.get('#reservation_renouvellement').select('1')
    cy.get('button[type="submit"]').click();

    cy.get('.alert.alert-danger.justify-content-center[role="alert"]').should('be.visible');
  });
});
