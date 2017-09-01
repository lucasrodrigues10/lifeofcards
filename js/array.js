function criaMatriz(linhas,colunas) {
	x = new Array (linhas);
	for (i=0;i<linhas;i++)
		x[i] = new Array (colunas);
	return x;
}