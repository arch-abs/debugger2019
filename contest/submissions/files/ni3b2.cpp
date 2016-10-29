#include <iostream>
#include <stdlib.h>
using namespace std;

class node{
    public:
    int data;
    node *next;
};
 void deleteNode( node *head, node *n)
    {
        // When node to be deleted is head node
        if(head == n)
        {
            if(head->next == NULL)
            {
                cout << "There is only one node. The list can't be made empty ";
                return;
            }
     
            /* Copy the data of next node to head */
            head->data = head->next->data;
     
            // store address of next node
            n = head->next;
     
            // Remove the link of next node
            head->next = head->next->next;
     
            // free memory
            free(n);
     
            return;
        }
     
     
        // When not first node, follow the normal deletion process
     
        // find the previous node
        node *prev = head;
        while(prev->next != NULL && prev->next != n)
            prev = prev->next;
     
        // Check if node really exists in Linked List
        if(prev->next == NULL)
        {
            cout << "\n Given node is not present in Linked List";
            return;
        }
     
        // Remove node from Linked List
        prev->next = prev->next->next;
     
        // Free memory
        free(n);
     
        return; 
    }
 
/* Utility function to insert a node at the begining */
void push( node **head_ref, int new_data)
{
     node *new_node = ( node *)malloc(sizeof( node));
    new_node->data = new_data;
    new_node->next = *head_ref;
    *head_ref = new_node;
}
 
/* Utility function to print a linked list */
void printList( node *head)
{
    while(head!=NULL)
    {
        cout << head->data;
        head=head->next;
    }
    cout << "\n";
}
 
int main(){
     node *head = NULL;
    push(&head,3);
    push(&head,2);
    push(&head,6);
    push(&head,5);
    push(&head,11);
    push(&head,10);
    push(&head,15);
    push(&head,12);
     cout << "Given Linked List: ";
    printList(head);
    /* Let us delete the node with value 10 */
    cout << "\nDeleting node :" << head->next->next->data;
    deleteNode(head, head->next->next);
    cout << "\nModified Linked List: ";
    printList(head);
    /* Let us delete the the first node */
     cout << "\nDeleting first node ";
    deleteNode(head, head);
    cout << "\nModified Linked List: ";
    printList(head);
    return 0;
}



