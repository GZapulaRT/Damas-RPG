#include "raylib.h"
#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include <math.h>

//Object Inclusion
#include "board.h"
#include "piece.h"

int main(void)
{
    // Initialization
    //--------------------------------------------------------------------------------------
    const int screenWidth = 920;
    const int screenHeight = 750;

    Tile* selectedTile = NULL;

    int playerTurn = 0;

    int score[2] = {0,0};

    char score_text_p1[128], score_text_p2[128];

    Board board = CreateLogicBoard();

    InitWindow(screenWidth, screenHeight, "Damas");

    SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
    //--------------------------------------------------------------------------------------

    // Main game loop
    while (!WindowShouldClose())    // Detect window close button or ESC key
    {

        sprintf(score_text_p1, "Pontos J1: %d", score[0]);
        sprintf(score_text_p2, "Pontos J2: %d", score[1]);

        BeginDrawing();

            	ClearBackground(RAYWHITE);

                UpdateBasePos(&board);
                
            	DrawBoard(board);

                DrawText(score_text_p1, board.basePosX, board.basePosY-40, 25, DARKBLUE);
                DrawText(score_text_p2, board.basePosX, board.basePosY+(tileSize*boardSize)+15, 25, DARKGREEN);

        EndDrawing();

        if(IsMouseButtonPressed(MOUSE_LEFT_BUTTON) && selectedTile){
            Tile* cursorTile = GetCursorTile(board);
            
            // Lógica de Transferência de Peça/Desseleção de Tile
            if(selectedTile) 
            {
                if(cursorTile)
                    if(
                        (cursorTile->x + cursorTile->y)%2 && //Se a tile for válida, 
                        (abs(cursorTile->x - selectedTile->x) <= selectedTile->piece->Mov && 
                        abs(cursorTile->y - selectedTile->y) <= selectedTile->piece->Mov) // E dentro dos parametros de movimento da peça
                      ) 
                    {
                        if(cursorTile->piece == NULL || cursorTile->piece->Owner != playerTurn){ //Se for um espaço vazio ou uma peça oponente

                            if(cursorTile->piece){
                                score[playerTurn]++;
                                free(cursorTile->piece);
                            } //Adiciona score e Limpa a memória se for uma peça oponente

                            cursorTile->piece = selectedTile->piece; // transfere a peça
                            selectedTile->piece = NULL;
                            playerTurn = !playerTurn;   // passa a rodada
                        }
                        
                        
                    }
                
                selectedTile->selected = false; //desseleciona a tile
                selectedTile = NULL;    // Tira endereço da Selected Tile
            }
        }

        else if(IsMouseButtonPressed(MOUSE_LEFT_BUTTON)){
            Tile* cursorTile = GetCursorTile(board);

            // Lógica de Seleção de Tile
            if(cursorTile && cursorTile->piece && playerTurn == cursorTile->piece->Owner){
                cursorTile->selected = true;

                selectedTile = cursorTile;
            }
            
        }

        if(IsMouseButtonPressed(MOUSE_BUTTON_RIGHT) && selectedTile){

            // Lógica de Desseleção de Tile via botão direito do mouse

            selectedTile->selected = false;
            selectedTile = NULL;
        }


        //----------------------------------------------------------------------------------
    }

    // De-Initialization
    //--------------------------------------------------------------------------------------
    ClearBoard(board);
    CloseWindow();        // Close window and OpenGL context
    //--------------------------------------------------------------------------------------

    return 0;
}