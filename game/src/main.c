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

    Vector2 turn_indicator_tri[3];
    Color turn_indicator_color;

    int loop_timer = 0;
    float turn_indicator_offset;

    char score_text_p1[128], score_text_p2[128];

    Board board = CreateLogicBoard();

    InitWindow(screenWidth, screenHeight, "Damas");

    SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
    //--------------------------------------------------------------------------------------

    // Main game loop
    while (!WindowShouldClose())    // Detect window close button or ESC key
    {

        //Timer de animação pra coisas que rodam em loop
        loop_timer++;


        //Construindo o indicador de turno...

        turn_indicator_offset = (sinf(loop_timer*PI/30))*10;

        if(playerTurn == 0){
            turn_indicator_tri[0].x = board.basePosX+(boardSize*tileSize)-turn_indicator_offset; turn_indicator_tri[0].y = board.basePosY-40;
            turn_indicator_tri[2].x = board.basePosX+(boardSize*tileSize)-turn_indicator_offset; turn_indicator_tri[2].y = board.basePosY-10;
            turn_indicator_tri[1].x = board.basePosX+(boardSize*tileSize)-turn_indicator_offset-20; turn_indicator_tri[1].y = board.basePosY-25;
            turn_indicator_color = DARKBLUE;
        }
        else{
            turn_indicator_tri[1].x = board.basePosX+turn_indicator_offset; turn_indicator_tri[1].y = board.basePosY+40+(boardSize*tileSize);
            turn_indicator_tri[0].x = board.basePosX+turn_indicator_offset; turn_indicator_tri[0].y = board.basePosY+10+(boardSize*tileSize);
            turn_indicator_tri[2].x = board.basePosX+20+turn_indicator_offset; turn_indicator_tri[2].y = board.basePosY+25+(boardSize*tileSize);
            turn_indicator_color = DARKGREEN;
        }
        
        //Os índices aqui estão todos fodidos por que o raylib só aceita vértices no DrawTriangle se elas forem em sentido anti-horário. Culpe o Raymond Hill essa bagunça -lua 9/4/2022 12:20

        //Strings de pontuação.
        sprintf(score_text_p1, "Pontos J1: %d", score[0]);
        sprintf(score_text_p2, "Pontos J2: %d", score[1]);

        BeginDrawing();

            	ClearBackground(RAYWHITE);

                UpdateBasePos(&board);
                
            	DrawBoard(board);

                //Desenhar as pontuações.
                DrawText(score_text_p1, board.basePosX-20, board.basePosY-40, 25, DARKBLUE);
                DrawText(score_text_p2, board.basePosX+(tileSize*boardSize)-120, board.basePosY+(tileSize*boardSize)+15, 25, DARKGREEN);


                //Indicador de turno; ver linhas 43-64
                DrawTriangle(turn_indicator_tri[0], turn_indicator_tri[1], turn_indicator_tri[2], turn_indicator_color);

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